@extends('layouts.frontend')

@section('content')
	@foreach(\App\Models\Page::where('uri', Request::path())->get() as $page)
	    About US
		<img width="100%" src="{{ Storage::url($page->photo) }}">
	@endforeach()
@endsection