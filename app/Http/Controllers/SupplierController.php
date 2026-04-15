<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = \App\Models\Supplier::all();
        return view('pages.Suppliers', compact('suppliers'));
    }

    public function store(Request $request)
    {
        \App\Models\Supplier::create($request->all());
        return back();
    }
}