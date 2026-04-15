@extends('layouts.app')

@section('content')

<div class="space-y-6">

<div class="flex justify-between">
    <div>
        <h1 class="text-2xl">Kelola Barang</h1>
        <p class="text-gray-500">Manajemen produk</p>
    </div>
</div>

<form method="POST" action="/products" class="grid grid-cols-3 gap-3 bg-white p-4 rounded-xl shadow">
@csrf

<input name="barcode" placeholder="Barcode" class="border p-2 rounded">
<input name="name" placeholder="Nama" class="border p-2 rounded">
<input name="buy_price" placeholder="Harga Beli" class="border p-2 rounded">
<input name="profit" placeholder="Profit %" class="border p-2 rounded">
<input name="stock" placeholder="Stock" class="border p-2 rounded">

<button class="bg-green-600 text-white rounded">Tambah</button>

</form>

<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">
<tr>
<th class="p-3 text-left">Nama</th>
<th class="p-3 text-right">Harga</th>
<th class="p-3 text-right">Stock</th>
</tr>
</thead>

<tbody>

@foreach($products as $p)
<tr class="border-t hover:bg-gray-50">
<td class="p-3">{{ $p->name }}</td>
<td class="p-3 text-right">Rp {{ number_format($p->sell_price) }}</td>
<td class="p-3 text-right">{{ $p->stock }}</td>
</tr>
@endforeach

</tbody>

</table>

</div>

</div>

@endsection