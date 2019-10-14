<?php

namespace Ramivel\Multiauth\Console\Commands;

use Illuminate\Console\Command;

class View extends Command{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'set:view {name} {path=null}';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'This Command Used To Set Recource Views Files With Data';

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
    parent::__construct();
    }

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function handle()
    {
        $this->viewIndex();
        $this->viewCreate();
        $this->viewEdit();
        $this->viewShow();
    }
    public function createPath($path=null){
        if (!is_null($path)) 
        {
            $path = str_replace('\\', '/', $path);
            $pathArray = explode('/', $path);

            $d ='';
            $paths = [];
            foreach ($pathArray as $key => $dir) {
                $d .= $key == 0 ? $dir : '/'.$dir;
                $paths[] = $d;
            }
            foreach ($paths as $folder) 
            {
                if (!is_dir($folder)) 
                {
                    @mkdir($folder);
                }
            }
        }
    }

    public function viewIndex(){
        if ($this->argument('path') == 'null') 
        {
            $path = base_path('resources/views').'/'.str_plural(snake_case($this->argument('name')));
        }else{

            $path = base_path('resources/views').'/'.$this->argument('path').'/'.str_plural(snake_case($this->argument('name')));

        }
        if (!is_dir($path)) 
        {
            $this->createPath($path);
            $this->info('Folder ('.str_plural(snake_case($this->argument('name'))).') Was Created Successfuly.');
        }else{
            $this->error('Folder ('.str_plural(snake_case($this->argument('name'))).') already Exist!');
        }

        $data = '@extends(\'layouts.backend\')
@section(\'title\') {{ trans(\'lang.'.str_plural(snake_case($this->argument('name'))).'\') }}  @endsection
@section(\'content\')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ trans(\'lang.'.str_plural(snake_case($this->argument('name'))).'\') }} 
                <span class="float-right">
                    {!! Btn::create() !!}
                </span>
            </h3>
        </div>

        <div class="block-content">
            @include(\'partials.message\')
            <div class="table-responsive">
                <table id="datata" class="table table-bordered table-striped table-vcenter js-dataTable-buttons table-vcenter">
                    <thead>
                        <tr>
                            <th>{{ trans(\'lang.title\') }}</th>
                            <th>{{ trans(\'lang.photo\') }}</th>
                            <th>{{ trans(\'lang.stutes\') }}</th>
                            <th>{{ trans(\'lang.create-at\') }}</th>
                            <th>{{ trans(\'lang.action\') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($'.str_plural(snake_case($this->argument('name'))).' as $'.str_singular(snake_case($this->argument('name'))).')
                            <tr>
                                <td>{{ $'.str_singular(snake_case($this->argument('name'))).'->trans(\'title\') }}</td>
                                <td><img  src="{{ Storage::url($'.str_singular(snake_case($this->argument('name'))).'->photo) }}" style="max-width:50px;"></td>
                                <td>{{ $'.str_singular(snake_case($this->argument('name'))).'->trans(\'stutes\') }}</td>
                                <td>{{ date(\'Y/m/d\',strtotime($'.str_singular(snake_case($this->argument('name'))).'->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {!! Btn::view($'.str_singular(snake_case($this->argument('name'))).'->id) !!}
                                        {!! Btn::edit($'.str_singular(snake_case($this->argument('name'))).'->id) !!}
                                        {!! Btn::delete($'.str_singular(snake_case($this->argument('name'))).'->id,$'.str_singular(snake_case($this->argument('name'))).'->trans(\'name\')) !!}
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



@endsection';
        if (!file_exists($path.'/index.blade.php')) 
        {
            $file = fopen($path.'/index.blade.php', "w");
            fwrite($file, $data);
            fclose($file);
            $this->info('File (index.blade.php) Was Created Successfuly.');
        }else{
            $this->error('File (index.blade.php) already Exist!');
        }
    }


    public function viewCreate(){
        if ($this->argument('path') == 'null') 
        {
            $path = base_path('resources/views').'/'.str_plural(snake_case($this->argument('name')));
        }else{

            $path = base_path('resources/views').'/'.$this->argument('path').'/'.str_plural(snake_case($this->argument('name')));

        }

        $data = '@extends(\'layouts.backend\')
@section(\'title\') {{ trans(\'lang.'.str_plural(snake_case($this->argument('name'))).'\') }}  @endsection
@section(\'content\')

<div class="content">
    @include(\'partials.message\')
    {!! bsForm::start([\'route\'=>\''.str_plural(snake_case($this->argument('name'))).'.store\',\'enctype\'=>\'multipart/form-data\']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans(\'lang.create-new-'.str_plural(snake_case($this->argument('name'))).'\') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form){
                            $form->text(\'title\');
                            $form->textarea(\'content\',null,[\'class\'=>\'form-control\']);
                        }) !!}
                        {!! bsForm::uri(\'uri\') !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans(\'lang.options\') }}</div>
                    <div class="block-content">
                        {!! bsForm::image(\'photo\') !!}
                        <hr>
                        {!! bsForm::radio(\'stutes\',[
                            \'active\'=> trans(\'lang.active\'),
                            \'not active\'=> trans(\'lang.not-active\'),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection';
        if (!file_exists($path.'/create.blade.php')) 
        {
            $file = fopen($path.'/create.blade.php', "w");
            fwrite($file, $data);
            fclose($file);
            $this->info('File (create.blade.php) Was Created Successfuly.');
        }else{
            $this->error('File (create.blade.php) already Exist!');
        }
    }  


    public function viewEdit(){
        if ($this->argument('path') == 'null') 
        {
            $path = base_path('resources/views').'/'.str_plural(snake_case($this->argument('name')));
        }else{

            $path = base_path('resources/views').'/'.$this->argument('path').'/'.str_plural(snake_case($this->argument('name')));

        }
        
        $data = '@extends(\'layouts.backend\')
@section(\'title\') {{ trans(\'lang.'.str_plural(snake_case($this->argument('name'))).'\') }}  @endsection
@section(\'content\')

<div class="content">
    @include(\'partials.message\')
    {!! bsForm::start([\'route\'=>[\''.str_plural(snake_case($this->argument('name'))).'.update\',$'.str_singular(snake_case($this->argument('name'))).'->id],\'files\'=>true,\'method\'=>\'put\']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans(\'lang.edit-'.str_plural(snake_case($this->argument('name'))).'\') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($'.str_singular(snake_case($this->argument('name'))).'){
                            $form->text(\'title\',$'.str_singular(snake_case($this->argument('name'))).'->trans(\'title\',$lang));
                            $form->textarea(\'content\',$'.str_singular(snake_case($this->argument('name'))).'->trans(\'content\',$lang),[\'class\'=>\'form-control\']);
                        }) !!}
                        {!! bsForm::uri(\'uri\',$'.str_singular(snake_case($this->argument('name'))).'->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans(\'lang.options\') }}</div>
                    <div class="block-content">
                        {!! bsForm::image(\'photo\',$'.str_singular(snake_case($this->argument('name'))).'->photo) !!}
                        <hr>
                        {!! bsForm::radio(\'stutes\',[
                                \'active\'=> trans(\'lang.active\'),
                                \'not active\'=> trans(\'lang.not-active\'),
                            ],$'.str_singular(snake_case($this->argument('name'))).'->stutes) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection';
        if (!file_exists($path.'/edit.blade.php')) 
        {
            $file = fopen($path.'/edit.blade.php', "w");
            fwrite($file, $data);
            fclose($file);
            $this->info('File (edit.blade.php) Was Created Successfuly.');
        }else{
            $this->error('File (edit.blade.php) already Exist!');
        }
    }



    public function viewShow(){
        if ($this->argument('path') == 'null') 
        {
            $path = base_path('resources/views').'/'.str_plural(snake_case($this->argument('name')));
        }else{

            $path = base_path('resources/views').'/'.$this->argument('path').'/'.str_plural(snake_case($this->argument('name')));

        }

        $data = '@extends(\'layouts.backend\')
@section(\'title\') {{ trans(\'lang.'.str_plural(snake_case($this->argument('name'))).'\') }}  @endsection
@section(\'content\')
    <div class="content">
        <div class="block py-3">
            <div class="block-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="block py-3">
                            <h1>{!! $'.str_singular(snake_case($this->argument('name'))).'->trans(\'title\') !!}</h1>
                            {!! $'.str_singular(snake_case($this->argument('name'))).'->trans(\'content\') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
@endsection';
        if (!file_exists($path.'/show.blade.php')) 
        {
            $file = fopen($path.'/show.blade.php', "w");
            fwrite($file, $data);
            fclose($file);
            $this->info('File (show.blade.php) Was Created Successfuly.');
        }else{
            $this->error('File (show.blade.php) already Exist!');
        }
    }
}
