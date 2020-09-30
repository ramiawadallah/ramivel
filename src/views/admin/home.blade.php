@extends('layouts.backend')
@section('content')
    <main>
        <div class="bg-body-light">
            <div class="col-md-12 content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="h3 font-w700 mb-2">
                            {{ __('Main dashboard') }}
                        </h1>
                        <h2 class="h6 font-w500 text-muted mb-0">
                            Welcome <a class="font-w600" href="javascript:void(0)">{{ Auth::user()->name }}</a>, everything looks great.
                            <br/>
                            You are logged in to {{ config('multiauth.prefix') }} side!
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('message')
    
    <div class="col-md-12 mt-3">
        <div class="row row-deck">
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">{{ \App\Model\Admin::count() }}</dt>
                            <dd class="text-muted mb-0">{{ __('Admin') }}</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="si si-user-follow font-size-h3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">{{ \App\Model\Role::count() }}</dt>
                            <dd class="text-muted mb-0">{{ __('Role') }}</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="si si-badge  font-size-h3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection