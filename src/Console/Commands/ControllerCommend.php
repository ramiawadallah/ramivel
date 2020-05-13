<?php

namespace Ramivel\Multiauth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class ControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ramivel:controller {name} {path=null} {api_path=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Used To Set Controller With Data';

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

     public function Controller($data)
     {
        $path = $this->argument('path') == 'null' ? null : $this->argument('path').'\\';

        $controller_path = app_path('Http/Controllers/'.$data['controller'].'.php');

        $path = str_replace('/', '\\', $path);
        
        // $this->createPath($path);
        $myfile = fopen($controller_path,'w');

        $txt = "Controller\n";
        fwrite($myfile, $txt);
        fclose($myfile);

        $content = file_get_contents($controller_path);
        $namespace = $this->argument('path') == 'null' ? null : '\\'.$this->argument('path');

        
        $prefix = strtolower(Str::singular(Str::snake($data['model'])));
        $prefixs = strtolower(Str::plural(Str::snake($data['model'])));
        $name = ucfirst(Str::singular(Str::camel($this->argument('name'))));

        $model = str_replace('/', '\\', ucfirst(Str::singular($prefixs)));

        $controller = $name.'Controller';

        $code ='<?php

namespace App\Http\Controllers'.$namespace.';

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use Auth;
use App\\'.''.$model.';

class '.$controller.' extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware(\'auth:admin\');
    }

    public function index()
    {
        $'.$prefixs.' = '.$model.'::all();
        return view(\'admin.'.$prefixs.'.index\',compact(\''.$prefixs.'\',$'.$prefixs.'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(\'admin.'.$prefixs.'.create\');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = [];

        foreach ($request->all() as $key => $value) {
            if(is_array($value))
            {
                  $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
            } else {
                  $data[$key] = $value;
            }
        }

        $this->validate($request,[
            \'title.*\' => \'required|max:255\',
            \'content.*\' => \'required\',
            \'photo\' => \'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048\',
            \'status\' => \'required\',
            \'uri\' => \'required\',
        ]);

        //Request Photo Upload
        if(request()->hasFile(\'photo\')) {
           $data[\'photo\'] = Up()->upload([
                // \'new_name\'      =>  \'\',
                \'file\'          =>  \'photo\',
                \'path\'          =>  \'public/'.$prefixs.'\',
                \'upload_type\'   =>  \'single\',
                \'delete_file\'   =>  \'\',
           ]); 
        }else{
          $data[\'photo\'] = null;
        }

        $'.$prefix.' = new '.$model.';
        $'.$prefix.'->title = $data[\'title\'];
        $'.$prefix.'->content = $data[\'content\'];
        $'.$prefix.'->status = $data[\'status\'];
        $'.$prefix.'->uri = $data[\'uri\'];
        $'.$prefix.'->photo = $data[\'photo\'];
        $'.$prefix.'->created_by = auth()->user(\'admin\')->id;
        $'.$prefix.'->save();
        session()->flash(\'success\',trans(\'lang.created\'));
        return  redirect(\'admin/'.$prefixs.'\');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $'.$prefix.' = '.$model.'::find($id);
        return view(\'admin.'.$prefixs.'.show\',compact(\''.$prefix.'\',$'.$prefix.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $'.$prefix.' = '.$model.'::find($id);
        return view(\'admin.'.$prefixs.'.edit\',compact(\''.$prefix.'\',$'.$prefix.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];

        foreach ($request->all() as $key => $value) {
            if(is_array($value))
            {
                  $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
            } else {
                  $data[$key] = $value;
            }
        }

        $this->validate($request,[
            \'title.*\' => \'required|max:255\',
            \'content.*\' => \'required\',
            \'photo\' => \'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048\',
            \'status\' => \'required\',
            \'uri\' => \'required\',
        ]);

        $'.$prefix.' = '.$model.'::find($id);

        //Request Photo Upload
        if(request()->hasFile(\'photo\')) {
           $data[\'photo\'] = Up()->upload([
                // \'new_name\'      =>  \'\',
                \'file\'          =>  \'photo\',
                \'path\'          =>  \'public/'.$prefixs.'\',
                \'upload_type\'   =>  \'single\',
                \'delete_file\'   =>  \'\',
           ]); 
        }else{
          $data[\'photo\'] = $'.$prefix.'->photo;
        }

        $'.$prefix.'->title = $data[\'title\'];
        $'.$prefix.'->content = $data[\'content\'];
        $'.$prefix.'->status = $data[\'status\'];
        $'.$prefix.'->uri = $data[\'uri\'];
        $'.$prefix.'->photo = $data[\'photo\'];
        $'.$prefix.'->updated_by = auth()->user(\'admin\')->id;
        $'.$prefix.'->update();
        session()->flash(\'success\',trans(\'lang.updated\'));
        return  redirect(\'admin/'.$prefixs.'\');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $name = \''.$prefixs.'\';
        $'.$prefixs.' = '.ucfirst(Str::singular($prefixs)).'::findOrFail($id);
        \Storage::delete($'.$prefixs.'->photo);
        $'.$prefixs.'->delete();
        session()->flash(\'success\',trans(\'lang.delete\'));
        return back();
    }

    public function multi_delete(){
      if(is_array(request(\'item\'))){
        '.ucfirst(Str::singular($prefixs)).'::destroy(request(\'item\'));
      }else{
        '.ucfirst(Str::singular($prefixs)).'::find(request(\'item\'))->delete();
      }
      alert()->success(trans(\'lang.deleted\'));
      return back();
    }

}
';

            file_put_contents($controller_path,$code);
     }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = ucfirst(Str::singular(Str::camel($this->argument('name'))));
        $path = $this->argument('path') == 'null' ? null : $this->argument('path').'\\';
        $path = str_replace('/', '\\', $path);
        $namespace = $this->argument('path') == 'null' ? null : '\\'.$this->argument('path');
        $path_name = $this->argument('path') == 'null' ? null : $this->argument('path');
        $names = [
        'controller' => $path.$name.'Controller',
        'model' => $name,
        ];
        $this->createPath(app_path('Http/Controllers').'/'.$path);
        
        $path_url = str_replace('\\', '/', $names['controller']);
        $path_url = str_replace('/', '\\', app_path('Http/Controllers').'/'.$path_url.'.php');
            // $this->error(app_path('Http/Controllers').'/'.$path_url);
        if (file_exists($path_url)) 
        {
            $this->error('Controller [ '.$names['controller'].' ] Already Exist !');
        }else{

            $this->Controller($names);
            
            $this->info('Controller [ '.$names['controller'].' ] has been created successfuly');
        }
        
    }
}
