@extends('layouts.editor')
@section('title') {{ trans('lang.pages') }}  @endsection
@section('menu') {!! getBreadcrumbs('page')->create !!}  @endsection
@section('content')

<div class="container">
        <div class="page-error-404">
        <div class="error-symbol ico">
            <i class="entypo-attention"></i>
        </div>
        
        <div class="error-text">
            <h2>401</h2>
            <p>You don't have Permission!</p>
        </div>
        
    </div>
</div>

@endsection