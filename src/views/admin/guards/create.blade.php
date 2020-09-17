@extends('layouts.backend')
@section('content')

<div class="content">
    <div class="col-md-12">
        <div class="block">
             <div class="block-content">
                <div class="block-header">
                    <h3 class="block-title">
                        {{ __('Add guards') }}
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.guards.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="role">{{ __('Guard') }}</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="guards" required>
                                </div>

                                <h2 class="content-heading">
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        {{ __('Save') }}
                                    </button>
                                </h2>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection