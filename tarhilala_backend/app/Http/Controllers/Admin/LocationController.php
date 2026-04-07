<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rute;
use App\Models\JadwalPenjemputan;
use App\Models\User;

class LocationController extends Controller
{
    public function index() {
        $routes = Rute::all();
        $schedules = JadwalPenjemputan::with(['rute', 'driver'])->get();
        $drivers = User::where('role', 'petugas')->get(); // Ambil user role petugas
        return view('admin.location.index', compact('routes', 'schedules', 'drivers'));
    }
}
