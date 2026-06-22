@extends('layouts.app')
@section('content')
<h1>Your Cart</h1>
@php $total=0; @endphp
@if($cart)
  @foreach($cart as $row)
    <div class="p-3 bg-white my-2 rounded">{{ $row['name'] }} x {{ $row['quantity'] }} — ${{ number_format($row['subtotal'],2) }}</div>
    @php $total += $row['subtotal']; @endphp
  @endforeach
  <div class="mt-4 font-bold">Total: ${{ number_format($total,2) }}</div>
@else
  <p>Your cart is empty.</p>
@endif
@endsection
