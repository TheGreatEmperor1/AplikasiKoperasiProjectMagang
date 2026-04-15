@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <h1 class="text-2xl">Sistem Poin Anggota</h1>

    <div class="bg-white p-4 rounded-xl shadow">

        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Nama Anggota</th>
                    <th class="p-3 text-right">Total Transaksi</th>
                    <th class="p-3 text-right">Poin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $row)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $row['member_name'] }}</td>
                        <td class="p-3 text-right">
                            Rp {{ number_format($row['total_transaksi']) }}
                        </td>
                        <td class="p-3 text-right">
                            {{ $row['point'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-3 text-center text-gray-500">
                            Belum ada transaksi tunai anggota.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection
