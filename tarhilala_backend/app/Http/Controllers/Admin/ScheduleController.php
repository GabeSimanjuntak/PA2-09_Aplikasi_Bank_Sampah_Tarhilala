<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPenjemputan;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function store(Request $request) {
        JadwalPenjemputan::create($request->all());
        return back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        JadwalPenjemputan::findOrFail($id)->update($request->all());
        return back()->with('success', 'Jadwal diperbarui');
    }

    public function destroy($id) {
        JadwalPenjemputan::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal dihapus');
    }

    public $timestamps = true;
}
