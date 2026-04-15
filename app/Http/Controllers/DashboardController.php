<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.DashboardPage', [
            'products' => \App\Models\Product::count(),
            'members' => \App\Models\Member::count(),
        ]);
    }
}
