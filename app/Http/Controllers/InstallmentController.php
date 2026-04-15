<?php

namespace App\Http\Controllers;

class InstallmentController extends Controller
{
    public function index()
    {
        $installments = \App\Models\Installment::with('member')->get();
        return view('pages.Installments', compact('installments'));
    }

    public function pay($id)
    {
        $inst = \App\Models\Installment::find($id);
        $inst->current += 1;
        $inst->save();

        return back();
    }
}