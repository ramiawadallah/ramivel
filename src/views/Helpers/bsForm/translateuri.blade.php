   <div role="tabpanel">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">

      @foreach (App\Lang::all() as $key => $lang)
         <li role="presentation" class="{{ $key == 0 ? 'active' : '' }}">
            <a href="#page_lang_{{ $lang->code }}" aria-controls="page_lang_{{ $lang->code }}" role="tab" data-toggle="tab"><img src="{{ flug($lang->code) }}" > {{ $lang->name }}</a>
         </li>
      @endforeach
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
      @foreach (App\Lang::all() as $key => $lang)
         <div role="tabpanel" class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="page_lang_{{ $lang->code }}">

         <?php
         $langForm = new \App\Helpers\Src\langForm($lang->id);
          call_user_func_array($callback, [$langForm,$lang->code]);
         ?>

         </div>
      @endforeach
      </div>
   </div>
