<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // Menampilkan data petugas & admin
    public function index()
    {
        $employees = User::whereIn('role', ['petugas', 'admin'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.employee.index', compact('employees'));
    }

    // Menyimpan data petugas baru
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
            'role' => 'petugas',
        ]);

        return redirect()->back()->with('success', 'Petugas berhasil ditambahkan!');
    }

    // Mengupdate data petugas
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => "required|email|unique:users,email,$id",
            'nomor_telepon' => 'nullable|string|max:20',
        ]);

        $employee = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);

        return redirect()->back()->with('success', 'Petugas berhasil diperbarui!');
    }

    // Menghapus data petugas
    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->back()->with('success', 'Petugas berhasil dihapus!');
    }
}
