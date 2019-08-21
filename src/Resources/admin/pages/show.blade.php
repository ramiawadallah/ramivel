@extends('layouts.backend')
@section('title') {{ trans('lang.pages') }}  @endsection
@section('content')

<div class="animatedParent animateOnce">
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body b-b">
                        <h1>{!! $page->trans('title') !!}</h1>
                            <!-- Input -->
                            <div class="body">
                              	<p>{!! $page->trans('content') !!}</p>
                            </div>
                            <!-- #END# Input -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection