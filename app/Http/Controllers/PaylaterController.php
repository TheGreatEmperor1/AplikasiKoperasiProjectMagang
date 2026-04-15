<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Product;

class PaylaterController extends Controller
{
    public function index()
    {
        $customers = Member::all();
        $products  = Product::all();

        $items = session('paylater_items', []);

        return view('pages.paylater', compact('customers', 'products', 'items'));
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:members,id',
            'product_id'  => 'required|exists:products,id',
            'qty'         => 'required|integer|min:1',
        ]);

        $customer = Member::findOrFail($request->customer_id);
        $product  = Product::findOrFail($request->product_id);

        $items = session('paylater_items', []);

        $items[] = [
            'customer_id'   => $customer->id,
            'customer_name' => $customer->name,
            'product_id'    => $product->id,
            'product_name'  => $product->name,
            'qty'           => $request->qty,
            'price'         => $product->sell_price,   // ← pakai sell_price
        ];

        session(['paylater_items' => $items]);

        return redirect()->route('paylater.index');
    }
}
