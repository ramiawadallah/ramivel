<?php
    

    //Settings
    Route::get('settings','SettingController@index')->name('admin.settings');
    Route::get('settings/edit','SettingController@edit')->name('admin.settings.edit');
    Route::patch('settings/{setting}','SettingController@update')->name('admin.settings.update');
    Route::post('settings/updatetheme/{setting}','SettingController@updateTheme')->name('admin.settings.updatetheme');


    Route::GET('/home', 'AdminController@index')->name('admin.home');
    // Login and Logout
    Route::GET('/', 'LoginController@showLoginForm')->name('admin.login');
    Route::POST('/', 'LoginController@login');
    Route::POST('/logout', 'LoginController@logout')->name('admin.logout');

    // Password Resets
    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::POST('/password/reset', 'ResetPasswordController@reset');
    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::GET('/password/change', 'AdminController@showChangePasswordForm')->name('admin.password.change');
    Route::POST('/password/change', 'AdminController@changePassword');

    // Register Admins
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'RegisterController@register');
    Route::get('/{admin}/edit', 'RegisterController@edit')->name('admin.edit');
    Route::delete('/{admin}', 'RegisterController@destroy')->name('admin.delete');
    Route::patch('/{admin}', 'RegisterController@update')->name('admin.update');

    // Admin Lists
    Route::get('/show', 'AdminController@show')->name('admin.show');
    Route::get('/me', 'AdminController@me')->name('admin.me');

    // Admin Roles
    Route::post('/{admin}/role/{role}', 'AdminRoleController@attach')->name('admin.attach.roles');
    Route::delete('/{admin}/role/{role}', 'AdminRoleController@detach');

    // Roles
    Route::get('/roles', 'RoleController@index')->name('admin.roles');
    Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
    Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
    Route::delete('/role/{role}', 'RoleController@destroy')->name('admin.role.delete');
    Route::get('/role/{role}/edit', 'RoleController@edit')->name('admin.role.edit');
    Route::patch('/role/{role}', 'RoleController@update')->name('admin.role.update');

    // Active status
    Route::post('activation/{admin}', 'ActivationController@activate')->name('admin.activation');
    Route::delete('activation/{admin}', 'ActivationController@deactivate');
    Route::resource('permission', 'PermissionController');

    //Make new guard
    Route::get('guards','CommendController@indexGuard')->name('admin.guards');
    Route::get('guards/create','CommendController@createGuard')->name('admin.guards.create');
    Route::post('/guards/store', 'CommendController@storeGuard')->name('admin.guards.store');
    Route::delete('/guards/{guard}', 'CommendController@destroyGuard')->name('admin.guards.delete');

    //Migrate commend
    Route::get('migrate','CommendController@migrate')->name('admin.migrate');

    //Media
    Route::get('media','MediaController@index')->name('admin.media');
    Route::post('media/store','MediaController@store')->name('admin.media.store');
    Route::post('media/vatar/{id}','MediaController@updateAvatar')->name('admin.media.updateavatar');
    Route::post('media/vatar/setting','MediaController@updateAvatarSetting')->name('admin.media.updateavatarsetting');
    Route::delete('media/destroyavatar/{id}','MediaController@destroy')->name('admin.media.destroyavatar');

    Route::fallback(function () {
        return abort(404);
    });
