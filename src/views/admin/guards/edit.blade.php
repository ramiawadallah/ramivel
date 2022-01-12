@extends('layouts.backend') 
@section('content')

@foreach($guard as $g)
    <div class="content">
        <div class="col-md-12">
            <div class="block">
                 <div class="block-content">
                    <div class="block-header">
                        <h3 class="block-title">
                            {{ __('Edit guard') }}
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('admin.guards.update', $g->name) }}" method="post">
                                    @csrf @method('patch')
                                    <div class="form-group">
                                        <label for="guard">{{ __('Guard') }}</label>
                                        <input type="text" value="{{ $g->name }}" name="name" class="form-control" id="guard" required>
                                    </div>

                                    <button type="submit" class="btn btn-dark btn-sm">{{ __('Change') }}</button>
                                    <a href="{{ route('admin.guards') }}" class="btn btn-light btn-sm">{{ __('Back') }}</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection