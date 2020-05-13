@extends('layouts.backend')
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ ucfirst(config('multiauth.prefix')) }} Dashboard
            </h3>
        </div>
        <div class="block-content">
                You are logged in to {{ config('multiauth.prefix') }} side!
        </div>
    </div>
</div>
@endsection