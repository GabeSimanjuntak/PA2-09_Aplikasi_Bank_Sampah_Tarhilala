<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/', function () {
    return view('admin.login');
});

Route::post('/login', function (Request $request) {

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

    return redirect('/dashboard');
});

Route::get('/dashboard', function () {

    if (!session('admin_id')) {
        return redirect('/');
    }

    return view('admin.dashboard');
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
});
