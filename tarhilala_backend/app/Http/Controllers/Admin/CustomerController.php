<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Menampilkan data nasabah
    public function index()
    {
        $customers = User::where('role', 'nasabah')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.customers.index', compact('customers'));
    }

    // Menyimpan data nasabah baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_telepon' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->password),
            'role' => 'nasabah',
        ]);

        return redirect()->back()->with('success', 'Nasabah berhasil ditambahkan!');
    }

    // Mengupdate data nasabah
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => "required|email|unique:users,email,$id",
            'nomor_telepon' => 'nullable|string|max:20',
        ]);

        $customer = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()->back()->with('success', 'Nasabah berhasil diperbarui!');
    }

    // Menghapus data nasabah
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Nasabah berhasil dihapus!');
    }
}
