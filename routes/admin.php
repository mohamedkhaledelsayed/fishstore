<?php


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    // dashboard routes
    Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'],function () {

        // Admin login routes
        Route::get('login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('login','Auth\AdminLoginController@login')->name('admin.login.submit');

        // all dashboard pages after authenticated
        Route::group(['middleware' => 'auth:admin'],function () {
            // logout route
            Route::post('logout','Auth\AdminLoginController@logout')->name('admin.logout');
            // home route
            Route::get('/','DashboardController@index')->name('admin.home');



            // Admin users routes
            Route::resource('users','UserController')->except('show');
            Route::get('users/search_in_table','UserController@search_in_table');

            //Admin users routes
            Route::resource('admin_users','AdminUsersController')->except('show');
            Route::get('admin_users/search_in_table','AdminUsersController@search_in_table');

            // roles resource routes
            Route::resource('roles','RolesController')->except('show');
            Route::get('roles/search_in_table','RolesController@search_in_table');
            Route::get('orders','OrderController@index')->name('orders.index');
      
            Route::get('settings','SettingsController@index')->name('settings.index');
            Route::put('settings/{page}','SettingsController@update')->name('settings.update');
            Route::resource('categories','CategoryController')->except('show');
            Route::resource('attributes','AttributeController')->except('show');
            Route::get('attributes/search_in_table','AttributeController@search_in_table');
            Route::resource('governments','GovernmentController')->except('show');
            Route::get('governments/search_in_table','GovernmentController@search_in_table');
            Route::resource('cities','CityController')->except('show');
            Route::get('cities/search_in_table','CityController@search_in_table');
            Route::get('categories/search_in_table','CategoryController@search_in_table');

            Route::get('ordersdetails/{id}','OrderController@ordershow')->name('ordersdetails');
            Route::delete('categories/{id}/delete','CategoryController@delete')->name('categories.delete');
            Route::resource('products', 'ProductController')->except('show');
            Route::get('productsimages/{id}', 'ProductController@showimages')->name('productimages');
            Route::delete('productsimages/{id}','ProductController@deleteimage')->name('proudectsimage.delete');
            Route::get('products/search_in_table','ProductController@search_in_table');

            Route::delete('categories/attributes/{category}/{attributes}','CategoryController@destroy_category_attribute')->name('category.attributes.destroy');
            Route::post('categories/attributes/{category}','CategoryController@store_category_attribute')->name('category.attributes.store');
            Route::get('categories/attributes/{category}','CategoryController@get_attributes')->name('category.attributes.show');
            Route::get('categories/search_in_table','CategoryController@search_in_table');
            Route::get('notifications/create','NotificationController@create')->name('notification.index');
            Route::post('notifications','NotificationController@store')->name('notifications.store');
             Route::delete('order/delete/{id}', 'OrderController@destroy')->name('orders.delete');
             
             Route::delete('order/{id}', 'OrderController@update')->name('orders.update');


            

        });

    });
   
});
