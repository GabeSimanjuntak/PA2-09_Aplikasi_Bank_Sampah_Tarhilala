<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rute;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function store(Request $request) {
        Rute::create($request->all());
        return back()->with('success', 'Rute berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        Rute::findOrFail($id)->update($request->all());
        return back()->with('success', 'Rute diperbarui');
    }

    public function destroy($id) {
        Rute::findOrFail($id)->delete();
        return back()->with('success', 'Rute dihapus');
    }
}
