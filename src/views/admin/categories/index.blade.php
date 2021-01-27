@extends('layouts.backend')
@section('title') {{ __('Category list' ) }}  @endsection
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ __('Category') }} 
                <span class="float-right">
                    {!! Btn::create() !!}
                </span>
            </h3>
        </div>

        <div class="block-content">
            <div class="table-responsive">
                <table id="datata" class="table table-bordered table-striped table-vcenter js-dataTable-buttons table-vcenter">
                    <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Photo') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Create-at') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->trans('title') }}</td>
                                <td><img  src="{{ Storage::url($category->photo) }}" style="max-width:50px;"></td>
                                <td>{{ $category->trans('status') }}</td>
                                <td>{{ date('Y/m/d',strtotime($category->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {!! Btn::view($category->id) !!}
                                        {!! Btn::edit($category->id) !!}
                                        {!! Btn::delete($category->id,$category->trans('name')) !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection