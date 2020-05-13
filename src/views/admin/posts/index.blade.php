@extends('layouts.backend')
@section('title') {{ trans('lang.posts') }}  @endsection
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ trans('lang.posts') }} 
                <span class="float-right">
                    {!! bsForm::create() !!}
                </span>
            </h3>
        </div>

        <div class="block-content">
            <div class="table-responsive">
                <table id="datata" class="table table-bordered table-striped table-vcenter js-dataTable-buttons table-vcenter">
                    <thead>
                        <tr>
                            <th>{{ trans('lang.title') }}</th>
                            <th>{{ trans('lang.photo') }}</th>
                            <th>{{ trans('lang.status') }}</th>
                            <th>{{ trans('lang.create-at') }}</th>
                            <th>{{ trans('lang.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ transdata($post->title) }}</td>
                                <td><img  src="{{ Storage::url($post->photo) }}" style="max-width:50px;"></td>
                                <td>{{ $post->status }}</td>
                                <td>{{ date('Y/m/d',strtotime($post->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {!! bsForm::view($post->id) !!}
                                        {!! bsForm::edit($post->id) !!}
                                        {!! bsForm::delete($post->id) !!}
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