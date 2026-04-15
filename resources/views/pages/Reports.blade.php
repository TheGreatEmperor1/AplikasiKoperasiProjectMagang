@extends('layouts.app')

@section('content')

<h1 class="text-2xl mb-4">Laporan</h1>

<div class="grid grid-cols-4 gap-4">

<div class="bg-white p-4 rounded-xl shadow">
<p>Total Penjualan</p>
<h2 class="text-green-600">Rp {{ number_format($sales) }}</h2>
</div>

<div class="bg-white p-4 rounded-xl shadow">
<p>Hutang</p>
<h2 class="text-red-500">Rp {{ number_format($debt) }}</h2>
</div>

<div class="bg-white p-4 rounded-xl shadow">
<p>Piutang</p>
<h2>Rp {{ number_format($receivables) }}</h2>
</div>

<div class="bg-white p-4 rounded-xl shadow">
<p>Tabungan</p>
<h2>Rp {{ number_format($savings) }}</h2>
</div>

</div>

@endsection