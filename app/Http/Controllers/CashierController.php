<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;

class CashierController extends Controller
{
    public function index()
    {
        return view('pages.Cashier', [
            'products' => Product::all(),
            'members'  => Member::all(),
        ]);
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'total'     => 'required|integer|min:0',
            'type'      => 'required|string',
            'member_id' => 'nullable|exists:members,id',
            'items'     => 'nullable|array',
        ]);

        $transaction = Transaction::create([
            'total'        => $data['total'],
            'payment_type' => $data['type'],
            'member_id'    => $data['member_id'] ?? null,
        ]);

        if (
            $data['type'] === 'debt'
            && !empty($data['member_id'])
            && !empty($data['items'])
        ) {
            $member = Member::find($data['member_id']);

            if ($member) {
                $itemsSession = session('paylater_items', []);

                foreach ($data['items'] as $cartItem) {
                    $productId = $cartItem['id']  ?? null;
                    $qty       = $cartItem['qty'] ?? 1;
                    $price     = $cartItem['price'] ?? null;

                    $product = Product::find($productId);
                    if (! $product) {
                        continue;
                    }

                    $qty   = (int) $qty;
                    $price = (int) ($price ?? $product->sell_price);

                    $itemsSession[] = [
                        'customer_id'   => $member->id,
                        'customer_name' => $member->name,
                        'product_id'    => $product->id,
                        'product_name'  => $product->name,
                        'qty'           => $qty,
                        'price'         => $price,
                        'paid'          => 0,
                    ];
                }

                session(['paylater_items' => $itemsSession]);
            }
        }

        return response()->json([
            'status'          => 'success',
            'transaction_id'  => $transaction->id,
        ]);
    }
}
