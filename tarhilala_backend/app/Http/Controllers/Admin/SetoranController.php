<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function index()
    {
        return view('admin.setoran.index');
    }
}
