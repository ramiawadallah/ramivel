@if (count($rows) > 0)

    @if ($position == 'header')
        <ul class="{{ $parent == 0 ? ($position == 'header' ? 'menu' : '') : '' }}">
            @foreach($rows as $row)
                <?php
                    $nameUrl = 'pages';//str_plural($name);
                    $url = empty($row->page->urlname) ? url($nameUrl.'/'.$row->page->id) : url($nameUrl.'/'.$row->page->urlname);
                    $url = !empty($row->page->out_url) ? $row->page->out_url : $url;
                    $model = '\App\\'.str_singular(ucfirst($name));
                    $countChild = $model::where('parent',$row->id)->count();
                    if ($countChild > 0) { $url = 'javascript:;'; }

                ?>
                @if ($row->page->active == 1)

                        <li><a href="{{ $url }}">{{ $row->page->trans('name') }}</a>
                            {!! \Control::mainOrderHtml($name,$parentName,$row->id,$position) !!}
                        </li>
                @endif
            @endforeach 
        </ul>
    @elseif($position == 'footer')
    <ul>
        @foreach($rows as $row)
            <?php
                $nameUrl = 'pages';//str_plural($name);
                $url = empty($row->page->urlname) ? url($nameUrl.'/'.$row->page->id) : url($nameUrl.'/'.$row->page->urlname);
                $url = !empty($row->page->out_url) ? $row->page->out_url : $url;
                $model = '\App\\'.str_singular(ucfirst($name));
                $countChild = $model::where('parent',$row->id)->count();
                if ($countChild > 0) { $url = 'javascript:;'; }

            ?>
            @if ($row->page->active == 1)

                    <li><a href="{{ $url }}">{{ $row->page->trans('name') }}</a>
                        {!! \Control::mainOrderHtml($name,$parentName,$row->id,$position) !!}
                    </li>
            @endif
        @endforeach 
    </ul>
    @endif
@endif
