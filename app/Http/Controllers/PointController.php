<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class PointController extends Controller
{
    public function index()
    {
        // Ambil total transaksi TUNAI per member
        $rows = Transaction::query()
            ->selectRaw('member_id, SUM(total) as total_transaksi')
            ->where('payment_type', 'cash')
            ->whereNotNull('member_id')
            ->groupBy('member_id')
            ->with('member')
            ->get();

        // Hitung poin
        $items = $rows->map(function ($row) {
            $total = (int) $row->total_transaksi;
            $point = (int) floor($total / 1000); // 1 poin per Rp 1.000

            return [
                'member_id'       => $row->member_id,
                'member_name'     => optional($row->member)->name ?? '-',
                'total_transaksi' => $total,
                'point'           => $point,
            ];
        });

        return view('pages.points', compact('items'));
    }
}
