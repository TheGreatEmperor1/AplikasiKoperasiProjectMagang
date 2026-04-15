@extends('layouts.app')

@section('content')

<div class="space-y-6">

<div>
    <h1 class="text-2xl md:text-3xl mb-2">Dashboard</h1>
    <p class="text-gray-600">Ringkasan aktivitas toko hari ini</p>
</div>

<div class="grid grid-cols-4 gap-4">

<div class="bg-white p-6 rounded-xl shadow">
    <p class="text-sm text-gray-600">Penjualan Hari Ini</p>
    <p class="text-2xl text-green-600">Rp 2.450.000</p>
</div>

<div class="bg-white p-6 rounded-xl shadow">
    <p class="text-sm text-gray-600">Total Produk</p>
    <p class="text-2xl text-green-600">{{ $products }}</p>
</div>

<div class="bg-white p-6 rounded-xl shadow">
    <p class="text-sm text-gray-600">Anggota</p>
    <p class="text-2xl text-green-600">{{ $members }}</p>
</div>

<div class="bg-white p-6 rounded-xl shadow">
    <p class="text-sm text-gray-600">Piutang</p>
    <p class="text-2xl text-red-500">Rp 15.000.000</p>
</div>

</div>

</div>

@endsection