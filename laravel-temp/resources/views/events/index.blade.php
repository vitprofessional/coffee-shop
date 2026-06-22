@extends('layouts.app')
@section('content')
<h1>Events</h1>
@foreach($events as $e)
  <div class="p-2 bg-white my-2">{{ $e->title }} - {{ $e->event_date }}</div>
@endforeach
{{ $events->links() }}
@endsection
