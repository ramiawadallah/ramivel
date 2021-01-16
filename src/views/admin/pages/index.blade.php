@extends('layouts.backend')
@section('title') {{ __('Page list' ) }}  @endsection
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ __('Pages') }} 
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
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->trans('title') }}</td>
                                <td><img  src="{{ Storage::url($page->photo) }}" style="max-width:50px;"></td>
                                <td>{{ $page->trans('status') }}</td>
                                <td>{{ date('Y/m/d',strtotime($page->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {!! Btn::view($page->id) !!}
                                        {!! Btn::edit($page->id) !!}
                                        {!! Btn::delete($page->id,$page->trans('name')) !!}
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