<h1 align="center">Ramivel</h1>

This package is just create admin side (multi auth), which is totaly isolated from your normal auth ( which we create using php artisan make:auth )

On top of that, you can use multiple authentication types, simultaneously, so you can be logged
in as a user and an admin, without conflicts!

## Version Guidance & installition

| Laravel version    	 | Branch | Install                                               |
  ------------------ 	 | ------ | ----------------------------------------------------- |
| 6.0 && 7.0			     | 1.6 	  | composer require ramivel/ramivel:1.0-dev              |
| 8.0			             | 1.8.1 	| composer require ramivel/ramivel:1.8.1-dev            |


Run This Commend 

```bash
composer update
```

After that

```bash
Connect database
```

Run This Commend 

```bash
php artisan ramivel:install 
```

Run This Commend 

```bash
php artisan storage:link
```

Run This Commend 

```bash
composer dump-autoload
```

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


