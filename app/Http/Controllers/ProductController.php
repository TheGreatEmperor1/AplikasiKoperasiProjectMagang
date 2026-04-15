<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::all();
        return view('pages.products', compact('products'));
    }

    public function store(Request $request)
    {
        $sell = $request->buy_price + ($request->buy_price * $request->profit / 100);

        \App\Models\Product::create([
            'barcode' => $request->barcode,
            'name' => $request->name,
            'buy_price' => $request->buy_price,
            'sell_price' => $sell,
            'stock' => $request->stock
        ]);

        return back();
    }
}