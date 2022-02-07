@extends('layouts.frontend')

@section('content')
	@foreach(\App\Models\Page::where('uri', Request::path())->get() as $page)

	@endforeach()
@endsection