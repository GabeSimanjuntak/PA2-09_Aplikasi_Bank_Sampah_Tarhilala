<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 1. Method untuk menampilkan halaman login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // 2. Method untuk proses login
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        if ($user->role != 'admin') {
            return back()->with('error', 'Akses hanya untuk admin');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }

        session([
            'admin_id' => $user->id,
            'admin_nama' => $user->nama
        ]);

        return redirect()->route('admin.dashboard');
    }

    // 3. Method Dashboard (INI YANG TADI HILANG/ERROR)
    public function dashboard()
    {
        // Cek session manual jika belum pakai middleware
        if (!session('admin_id')) {
            return redirect()->route('login');
        }

        return view('admin.dashboard');
    }

    // 4. Method Logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
