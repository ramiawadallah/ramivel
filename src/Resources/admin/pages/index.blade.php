@extends('layouts.backend')
        @section('title') {{ trans('lang.pages') }}  @endsection
        @section('content')

        <div class="content">
            <div class="block py-2">
                <div class="block-header">
                    <h3 class="block-title">
                        {{ trans('lang.pages') }} 
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
                                    <th>{{ trans('lang.title') }}</th>
                                    <th>{{ trans('lang.photo') }}</th>
                                    <th>{{ trans('lang.status') }}</th>
                                    <th>{{ trans('lang.create-at') }}</th>
                                    <th>{{ trans('lang.action') }}</th>
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