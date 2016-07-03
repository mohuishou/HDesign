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

#后台路由
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

        #退出登录
        $app->get('logout',[
            'as' => 'logout',
            'uses' => 'UserController@logout'
        ]);

        #系统设置路由
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

        #目录路由
        $app->get('category',[
            'as' => 'category.show',
            'uses' => 'CategoryController@index'
        ]);

        $app->post('category/add',[
            'as' => 'category.add',
            'uses' => 'CategoryController@add'
        ]);

        $app->post('category/update',[
            'as' => 'category.update',
            'uses' => 'CategoryController@update'
        ]);

        $app->post('category/del',[
            'as' => 'category.delete',
            'uses' => 'CategoryController@destroy'
        ]);

        #图集路由
        $app->get('album',[
            'as' => 'album.show',
            'uses' => 'AlbumController@index'
        ]);

        $app->post('album/add',[
            'as' => 'album.add',
            'uses' => 'AlbumController@add'
        ]);

        $app->post('album/update',[
            'as' => 'album.update',
            'uses' => 'AlbumController@update'
        ]);

        $app->post('album/del',[
            'as' => 'album.delete',
            'uses' => 'AlbumController@destroy'
        ]);

    });



    #登录路由
    $app->get('/login', ['as'=>'login.get',function () {
        return view('admin.login');
    }]);

    $app->post('/login',[
        'as' => 'login.post',
        'uses' => 'UserController@login'
    ]);
});

