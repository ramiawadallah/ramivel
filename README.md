<h1 align="center">Ramivel</h1>

This package is just create admin side (multi auth), which is totaly isolated from your normal auth ( which we create using php artisan make:auth )

On top of that, you can use multiple authentication types, simultaneously, so you can be logged
in as a user and an admin, without conflicts!

## Version Guidance & installition

| Laravel version    	 | Branch | Install                                       |
  ------------------ 	 | ------ | --------------------------------------------- |
| 6.0	 				 | 1.6 	  | composer require ramivel/ramivel:1.6.0-dev    |


php artisan ramivel:insall  


composer.json

```bash
    "autoload-dev": {
        "files":[
            "app/Helpers/helpers.php",
        ],
```

```bash
php artisan storage:link
```

Run This Commend 

```bash
composer dump-autoload
```