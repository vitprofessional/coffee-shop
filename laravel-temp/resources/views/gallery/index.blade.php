@extends('layouts.app')
@section('content')
<h1>Gallery</h1>
@foreach($items as $it)
  <div class="p-2 bg-white my-2">{{ $it->title }}</div>
@endforeach
{{ $items->links() }}
@endsection
