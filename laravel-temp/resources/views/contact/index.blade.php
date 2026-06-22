@extends('layouts.app')
@section('content')
<h1>Contact</h1>
<form method="post" action="{{ route('contact.store') }}">@csrf
  <label>Name<input name="name" required></label>
  <label>Message<textarea name="message" required></textarea></label>
  <button type="submit">Send</button>
</form>
@endsection
