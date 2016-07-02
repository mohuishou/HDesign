<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['as' => 'admin.','prefix' => 'admin/','namespace'=>'Admin\\'] ,function ($app) {

    $app->group(['middleware' => 'auth'],function($app){
        $app->get('/',[
            'as' => 'test',
            'uses' => 'AdminController@index'
        ]);
        $app->get('test', [
            'as' => 'test',
            'uses' => 'AdminController@index'
        ]);
        $app->get('logout',[
            'as' => 'logout',
            'uses' => 'UserController@logout'
        ]);


        $app->get('system',[
            'as' => 'system.show',
            'uses' => 'SystemController@index'
        ]);
        $app->post('system',[
            'as' => 'system.update',
            'uses' => 'SystemController@update'
        ]);
        $app->post('system/logo',[
            'as' => 'system.logo',
            'uses' => 'SystemController@logo'
        ]);

        $app->get('category',[
            'as' => 'category.show',
            'uses' => 'CategoryController@index'
        ]);

        $app->post('category/add',[
            'as' => 'category.add',
            'uses' => 'CategoryController@add'
        ]);

    });



    $app->get('/login', ['as'=>'login.get',function () {
        return view('admin.login');
    }]);

    $app->post('/login',[
        'as' => 'login.post',
        'uses' => 'UserController@login'
    ]);
});

