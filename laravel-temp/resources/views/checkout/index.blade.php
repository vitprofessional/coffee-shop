@extends('layouts.app')
@section('content')
<h1>Checkout</h1>
<form method="post" action="{{ route('order.store') }}">@csrf
  <label>Name<input name="customer_name" required></label>
  <label>Phone<input name="phone" required></label>
  <button type="submit">Place Order</button>
</form>
@endsection
