@extends('layouts.app')

@section('content')

<h1 class="text-2xl mb-4">Simpan Pinjam</h1>

<div class="bg-white p-4 rounded-xl shadow">

<table class="w-full">

<tr class="bg-gray-100">
<th class="p-3">Nama</th>
<th class="p-3">Tabungan</th>
<th class="p-3">Pinjaman</th>
</tr>

@foreach($data as $d)
<tr class="border-t">
<td class="p-3">{{ $d->name }}</td>
<td class="p-3">Rp {{ number_format($d->savings) }}</td>
<td class="p-3">Rp {{ number_format($d->loan) }}</td>
</tr>
@endforeach

</table>

</div>

@endsection