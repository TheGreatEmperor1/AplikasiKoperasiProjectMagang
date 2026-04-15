@extends('layouts.app')

@section('content')

<h2>Ajukan Pinjaman</h2>

<form method="POST" action="/loans">
@csrf

<input type="number" name="amount" placeholder="Jumlah Pinjaman" class="form-control mb-2">

<select name="duration" class="form-control mb-2">
    <option value="1">1 Bulan</option>
    <option value="3">3 Bulan</option>
    <option value="6">6 Bulan</option>
    <option value="12">12 Bulan</option>
</select>

<button class="btn btn-success">Ajukan</button>

</form>

@endsection