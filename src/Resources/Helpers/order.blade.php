@if (count($rows) > 0)
<ol class="dd-list ">
    @foreach($rows as $row)
    <li class="dd-item dd3-item" data-id="{{ $row->id }}">
    <div class="dd-handle dd3-handle" title="{{ trans('lang.order') }}"> </div>
        <div class="dd3-content">{{ @$row->page->trans('name') }} 
        <div class="pull-right">
             {!! Btn::view($row->id) !!}
             {!! Btn::edit($row->id) !!}
             {!! Btn::delete($row->id,@$row->page->trans('name')) !!}
        </div>
        </div>
        {!! \Control::orderHtml($name,$parentName,$row->id) !!}
    </li>
    @endforeach 
</ol>
@endif
