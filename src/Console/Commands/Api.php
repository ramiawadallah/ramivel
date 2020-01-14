<?php

namespace Ramivel\Multiauth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Container\Container;

class Api extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:api {name} {path=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Used To Set Api With Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function createPath($path=null, $api_path=null)
    {
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

    public function Api($data)
     {
        $path = $this->argument('path') == 'null' ? null : $this->argument('path').'\\';

        $controller_path = app_path('Http/Controllers/Api/'.$data['api'].'.php');

        $path = str_replace('/', '\\', $path);
        
        // $this->createPath($path);
        $myfile = fopen($controller_path,'w');

        $txt = "Api\n";
        fwrite($myfile, $txt);
        fclose($myfile);

        $content = file_get_contents($controller_path);
        $namespace = $this->argument('path') == 'null' ? null : '/'.$this->argument('path');

        
        $prefix = strtolower(str_singular(snake_case($data['model'])));
        $prefixs = strtolower(str_plural(snake_case($data['model'])));
        $name = ucfirst(str_singular(camel_case($this->argument('name'))));

        $model = str_replace('/', '\\', ucfirst(str_singular($prefixs)));

        $api = $name.'Api';

        $code ='<?php

namespace App\Http\Controllers\Api'.$namespace.';

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use Response;
use App\\'.''.$model.';

class '.$api.' extends Controller
{

    public function index()
    {
        $'.$prefixs.' = '.$model.'::all();
        return Response::json($'.$prefixs.');
    }


    public function show($id){
        $'.$prefix.' = '.$model.'::findOrFail($id);
        return Response::json($'.$prefix.');
    }

}

';


        file_put_contents($controller_path,$code);
    }


    public function handle()
    {
        $name = ucfirst(str_singular(camel_case($this->argument('name'))));
        $path = $this->argument('path') == 'null' ? null : $this->argument('path').'\\';
        $path = str_replace('/', '\\', $path);
        $namespace = $this->argument('path') == 'null' ? null : '\\'.$this->argument('path');
        $path_name = $this->argument('path') == 'null' ? null : $this->argument('path');
        $names = [
        'api' => $path.$name.'Api',
        'model' => $name,
        ];
        $this->createPath(app_path('Http/Controllers/Api').'/'.$path);
        
        $path_url = str_replace('\\', '/', $names['api']);
        $path_url = str_replace('/', '\\', app_path('Http/Controller').'/'.$path_url.'.php');
            // $this->error(app_path('Http/Api').'/'.$path_url);
        if (file_exists($path_url)) 
        {
            $this->error('Api [ '.$names['api'].' ] Already Exist !');
        }else{

            $this->Api($names);
            
            $this->info('Api [ '.$names['api'].' ] has been created successfuly');
        }
        
    }

}