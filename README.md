<h1 align="center">Ramivel</h1>

This package is just create admin side (multi auth), which is totaly isolated from your normal auth ( which we create using php artisan make:auth )

On top of that, you can use multiple authentication types, simultaneously, so you can be logged
in as a user and an admin, without conflicts!

## Version Guidance & installition

| Laravel version    	 | Branch | Install                                               |
  ------------------ 	 | ------ | ----------------------------------------------------- |
| 6.0	 				 | 1.6 	  | composer require ramivel/ramivel:1.6.0-dev            |
| 5.6, 5.7 and 5.8    	 | Master | composer require ramivel/ramivel                      |


 php artisan ramivel:insall  
 php artisan vendor:publish --tag=lfm_config
 php artisan vendor:publish --tag=lfm_public
 php artisan storage:link

 on lfm 'middlewares' => ['web', 'auth:admin'],

'bsForm' => App\Helpers\bsForm::class,
'up' => App\Http\Controllers\Admin\UploadController::class,


Add this trait on this following path ../vendor/laravel/framework/src/Illuminate/Database/Eloquent/Model.php

```bash

if (trait_exists('App\Relation\RelationMethods')) { 
    trait call_relation_helpers {
        use \App\Relation\RelationMethods; 
        } 
    }else{ 
        trait call_relation_helpers{} 
}


abstract class Model implements ArrayAccess, Arrayable, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    use call_relation_helpers,
    ......... atc
```

composer.json

```bash
    "autoload-dev": {
        "files":[
            "app/Helpers/helpers.php",
            "app/Helpers/Src/bsForm.php"
        ],
```

```bash
php artisan storage:link
```

Run This Commend 

```bash
composer dump-autoload
```

Change this code in ConfigHandler

```bash
<?php

namespace UniSharp\LaravelFilemanager\Handlers;

class ConfigHandler
{
    public function userField()
    {
        if(auth('admin')->check())
        {      
            return auth('admin')->user()->id;
        }
        else
        {
            return 'admin';
        }
    }



/*
    public function userField()
    {
        
        return auth()->user()->id;
    }
*/
}