# Laravel Multi Auth

- **Laravel**: 5.6/5.7/5.8
- **Author**: Rami Awadallah
- **Author Homepage**: https://ramiawadallah.com

This package is just create admin side (multi auth), which is totaly isolated from your normal auth ( which we create using php artisan make:auth )

On top of that, you can use multiple authentication types, simultaneously, so you can be logged
in as a user and an admin, without conflicts!

## Version Guidance

| Laravel version     | Branch   | Install                                                 |
| ------------------- | ------   | ------------------------------------------------------- |
| 5.4                 | 5.4      | composer require Ramvel/laravel-multiauth:5.4.x-dev   |
| 5.5                 | 5.5      | composer require Ramvel/laravel-multiauth:5.5.x-dev   |
| 5.6, 5.7 and 5.8    | Master   | composer require Ramvel/laravel-multiauth             |
| JWT Api version     | jwt-auth | composer require Ramvel/laravel-multiauth -b jwt-auth |

## Installation

Install via composer.

```bash
composer require ramvel/laravel-multiauth
```

Yuo must publish this line

```bash
php artisan vendor:publish --tag="multiauth:publish"
```

Run [the Migration](https://github.com/ramvel/laravel-multiauth/database/migrations/create_permission_tables.php) to have tables in your database.

```bash
php artisan migrate
```

## First Admin

Obviously, first time you need at least one super admin to login with and then create other admins.

```
php artisan multiauth:seed --role=super
```

Now you can login your admin side by going to https://localhost:8000/admin with creadential of **email = super@admin.com** and **password = secret**
Obviously you can later change these things.

## Register new Admin

To register new use you need to go to https://localhost:8000/admin/register.

Keep in mind that only a Super Admin can create new Admin.


**Validations**


## Activate or Deactive admin
Now super admin can activate or deactivate other admin.
This will be usefull when you want to deactivate any admin for some reason.

By default new admin is deactivate, so that you can activate him when you want.

To activate admin, just go to the proceedure of editing admin.

## Change Prefix

You can change the prefix in your config file you have just published.
With prefix we mean what you want to call your admin side, we call it admin you can call it whatever you want.
Suppose you have changed prefix to 'master' now everywhere instead of 'admin' word, that changed to 'master'

```php
 /*
    |--------------------------------------------------------------------------
    | Prefix
    |--------------------------------------------------------------------------
    |
    | Use prefix to before the routes of multiauth package.
    | This way you can keep your admin page secure.
    | Default : admin
    */
    'prefix' => 'admin', // can change it to, lets say 'prefix' => 'master'
```

## Redirect after Login

You can change the redirect path after login for admin section. Just change this setting on config/multiauth.php file.

```php
/*
    |--------------------------------------------------------------------------
    | Redirect After Login
    |--------------------------------------------------------------------------
    |
    | It will redirect to a path defined here after login.
    | You can change it to where ever you want to
    | redirect the admin after login.
    | Default : /admin/home
    */
    'redirect_after_login' => '/admin/home',
```

## Create Roles

To create a new role you have two options:

1. Using artisan command

```bash
php artisan multiauth:role rolename
```

2. Using Interface
   Just go to https://localhost:8000/admin/role.

Now you can click on 'Add Role' button to create new role.

**Edit or Delete Role can also be done with same interface**


## Access Level

**With Middleware**

1. You can use 'role' middleware to allow various admin for accessing certain section according to their role.

```php
Route::get('admin/check',function(){
    return "This route can only be accessed by admin with role of Editor"
})->middleware('role:editor');
```

Here it does't matter if you give role as uppercase or lowercase or mixed, this package take care of all these.

2. If you want a section to be accessed by only super user then use role:super middleware
   A super admin can access all lower role sections.

```php
Route::get('admin/check',function(){
    return "This route can only be accessed by super admin"
})->middleware('role:super');
```

**With Blade Syntax**

You can simply use blade syntax for showing or hiding any section for admin with perticular role.
For example, If you want to show a button for admin with role of editor then write.

```php
@admin('editor')
    <button>Only For Editor</button>
@endadmin
```

If you want to add multiple role, you can do like this

```php
@admin('editor,publisher,any_role')
    <button> This is visible to admin with all these role</button>
@endadmin
```

## Another Auth

**Apart from Admin section, you can make a another auth**

This is fully compatible with laravel `MustVerifyEmail` trait, so that you can make user to must verify email. [click here](https://laravel.com/docs/5.8/verification) more details


```php
php artisan multiauth:make {guard}
```

**You can rollback this auth also if you want.**

```php
php artisan multiauth:rollback {guard}
```
