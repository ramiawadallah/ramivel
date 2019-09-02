@extends('layouts.frontend')

@section('content')
	@foreach(\App\Page::where('uri', Request::path())->get() as $page)
		<img width="100%" src="{{ Storage::url($page->photo) }}">
	@endforeach()
@endsection
