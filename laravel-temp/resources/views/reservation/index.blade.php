@extends('layouts.app')
@section('content')
<h1>Reservation</h1>
<form method="post" action="{{ route('reservation.store') }}">@csrf
  <label>Name<input name="name" required></label>
  <label>Phone<input name="phone" required></label>
  <button type="submit">Reserve</button>
</form>
@endsection
