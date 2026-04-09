<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontenEdukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LibraryController extends Controller
{
    public function index() {
        $contents = KontenEdukasi::with('penulis')->latest()->get();
        return view('admin.library.index', compact('contents'));
    }

    public function store(Request $request) {
    $request->validate([
        'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
    ]);

    $data = $request->all();
    $data['slug'] = \Illuminate\Support\Str::slug($request->judul);
    $data['penulis_id'] = session('admin_id');

    // Logika Simpan File
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        // Simpan ke folder public/assets/img/thumbnails
        $file->move(public_path('assets/img/thumbnails'), $nama_file);
        $data['thumbnail'] = 'assets/img/thumbnails/' . $nama_file; // Ini yang masuk ke DB
    }

    \App\Models\KontenEdukasi::create($data);
    return back()->with('success', 'Konten berhasil diterbitkan');
    }

    public function update(Request $request, $id) {
        $content = KontenEdukasi::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);

        $content->update($data);
        return back()->with('success', 'Konten berhasil diperbarui');
    }

    public function destroy($id) {
        KontenEdukasi::findOrFail($id)->delete();
        return back()->with('success', 'Konten berhasil dihapus');
    }
}
