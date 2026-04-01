<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak. Bukan admin.'
            ], 403);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password salah'
            ], 401);
        }

        // BUAT TOKEN
        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'message' => 'Login admin berhasil',
            'token' => $token,
            'data' => $user
        ], 200);
    }
}
