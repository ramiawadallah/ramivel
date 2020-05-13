 <!-- Nav tabs -->

<div class="card no-b">
    <div class="card-header white pb-0">
        <div class="d-flex justify-content-between">
            <div class="align-self-center">
                <ul class="nav nav-pills mb-3" role="tablist">
                    @foreach (App\Lang::all() as $key => $lang)
                    <li class="nav-item">
                        <a class="nav-link {{ $key == 0 ? 'active' : '' }} show r-20" id="w3--{{ $lang->code }}" data-toggle="tab" href="#w3-{{ $lang->code }}" role="tab" aria-controls="{{ $lang->code }}" aria-expanded="true" aria-selected="true">{{ $lang->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
          
        </div>
    </div>
    <div class="card-body no-p">
        <div class="tab-content">
            @foreach (App\Lang::all() as $key => $lang)
            <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}" id="w3-{{ $lang->code }}" role="tabpanel" aria-labelledby="w3-{{ $lang->code }}">
                    <?php

                    $langForm = new \App\Helpers\Src\langForm($lang->id);

                    call_user_func_array($callback, [$langForm,$lang->code]);

                   ?>
            </div>
            @endforeach
        </div>
    </div>
</div>


