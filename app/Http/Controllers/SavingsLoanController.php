<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavingsLoanController extends Controller
{
    public function index()
    {
        $data = \App\Models\Member::all();
        return view('pages.SavingsLoan', compact('data'));
    }

    public function store(Request $request)
    {
        $member = \App\Models\Member::find($request->member_id);

        if($request->type == 'deposit'){
            $member->savings += $request->amount;
        }else{
            $member->debt += $request->amount;
        }

        $member->save();

        return back();
    }
}