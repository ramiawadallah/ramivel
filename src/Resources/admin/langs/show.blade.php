@extends('layouts.backend')
@section('title') {{ trans('lang.languages') }}  @endsection
@section('content')

<div class="animatedParent animateOnce">
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body b-b">
                        <h1>{!! $lang->trans('name') !!}</h1>
                            <!-- Input -->
                            <div class="body">
                              	<!-- <p>{!! $lang->trans('content') !!}</p> -->
                            </div>
                            <!-- #END# Input -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection