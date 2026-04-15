@extends('layouts.app')

@section('content')

<h1 class="text-2xl mb-4">Angsuran</h1>

@foreach($installments as $i)
<div class="bg-white p-4 rounded-xl shadow mb-4">

<p>{{ $i->member->name }}</p>
<p>Rp {{ number_format($i->amount) }}</p>
<p>{{ $i->current }}/{{ $i->total }}</p>

</div>
@endforeach

@endsection