@extends('layouts.backend')
@section('title') {{ trans('lang.pages') }}  @endsection
@section('content')

<div class="block">
     <div class="block-content">
        <div class="block-header">
            <h3 class="block-title">
                {{ trans('lang.pages') }} List
                <span class="float-right">
                    {!! Btn::create() !!}
                </span>
            </h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped js-dataTable-full js-table-checkable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">
                                    <label class="check">
                                        <input type="checkbox" id="checkAll" name="check-all"><span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>{{ trans('lang.name') }}</th>
                                <th>{{ trans('lang.uri') }}</th>
                                <th>{{ trans('lang.stutes') }}</th>
                                <th>{{ trans('lang.created-at') }}</th>
                                <th>{{ trans('lang.action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($pages as $page)
                            <tr>
                                <td class="text-center">
                                    <label class="check">
                                        <input type="checkbox" id="row_1" name="row_1"><span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>{{ $page->trans('title') }}</td>
                                <td><a href="{{ url($page->uri)}}" >{{ $page->pretty_uri }}</a></td>
                                <td>{{ $page->trans('stutes') }}</td>
                                <td>{{ date('Y/m/d',strtotime($page->created_at)) }}</td>
                                <td class="text-center">
                                        <div class="btn-group">
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
</div>


@endsection