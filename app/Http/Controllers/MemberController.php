<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $members = Member::when($search, function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%');
            })
            ->get();

        return view('pages.Members', compact('members', 'search'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:50',
            'address'      => 'nullable|string',
            'credit_limit' => 'required|integer|min:0',
        ]);

        Member::create($data);

        return back();
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:50',
            'address'      => 'nullable|string',
            'credit_limit' => 'required|integer|min:0',
        ]);

        $member->update($data);

        return back();
    }

    public function destroy(Member $member)
    {
        // Kalau di masa depan ada relasi (simpan pinjam, paylater, dll),
        // di sini bisa dicek dulu sebelum delete
        $member->delete();

        return back();
    }
}
