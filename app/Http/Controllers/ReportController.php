<?php

namespace App\Http\Controllers;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.Reports', [
            'sales' => \App\Models\Transaction::sum('total'),
            'debt' => \App\Models\Supplier::sum('debt'),
            'receivables' => \App\Models\Member::sum('debt'),
            'savings' => \App\Models\Member::sum('savings'),
        ]);
    }
}
