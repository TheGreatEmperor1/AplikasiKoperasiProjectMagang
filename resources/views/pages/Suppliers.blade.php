@extends('layouts.app')

@section('content')

<h1 class="text-2xl mb-4">Supplier</h1>

<div class="grid grid-cols-2 gap-4">

@foreach($suppliers as $s)
<div class="bg-white p-4 rounded-xl shadow">
<h2>{{ $s->name }}</h2>
<p>{{ $s->phone }}</p>
<p class="text-red-500">Rp {{ number_format($s->debt) }}</p>
</div>
@endforeach

</div>

@endsection