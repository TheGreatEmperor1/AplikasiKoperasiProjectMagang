@extends('layouts.app')

@section('content')

<h2>Tambah Produk</h2>

<form method="POST" action="/products" enctype="multipart/form-data">
@csrf

<input type="text" name="name" placeholder="Nama Produk" class="form-control mb-2">
<input type="number" name="price" placeholder="Harga" class="form-control mb-2">
<input type="file" name="image" class="form-control mb-2">

<button class="btn btn-success">Simpan</button>

</form>

@endsection