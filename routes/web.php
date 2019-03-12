<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'ProductoController@promociones',
    'as' => 'producto.promociones'
]);

Route::group(['prefix' => 'user'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);
    
        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);
        
        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);
        
        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);
    });
    
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [
            'uses' => 'UserController@profile',
            'as' => 'user.profile'
        ]);
        
        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);
            
        Route::patch('/{user}/update',  [
            'as' => 'user.update',
            'uses' => 'UserController@update'
        ]);
    });
});

Route::get('/productos', [
    'uses' => 'ProductoController@index',
    'as' => 'producto.index'
]);

Route::get('/add-to-cart/{id}', [
    'uses' => 'ProductoController@AddToCart',
    'as' => 'producto.addToCart'
]);

Route::get('/carrito', [
    'uses' => 'ProductoController@carrito',
    'as' => 'producto.carrito'
]);

Route::get('/checkout', [
    'uses' => 'ProductoController@getCheckout',
    'as' => 'checkout'
]);

Route::post('/checkout', [
    'uses' => 'ProductoController@postCheckout',
    'as' => 'checkout'
]);

Route::get('/reduceByOne/{id}', [
    'uses' => 'ProductoController@getReduceByOne',
    'as' => 'producto.reduceByOne'
]);

Route::get('/removeAll/{id}', [
    'uses' => 'ProductoController@getRemoveAll',
    'as' => 'producto.removeAll'
]);

Route::get('/promociones', [
    'uses' => 'ProductoController@promociones',
    'as' => 'producto.promociones'
]);

Route::get('/productos/filtrar', [
    'uses' => 'ProductoController@filtrar',
    'as' => 'producto.filtrar'
]);

Route::get('/sugerencias', [
    'uses' => 'SugerenciasController@index',
    'as' => 'sugerencias.index'
]);

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/sugerencias/create', [
        'uses' => 'SugerenciasController@create',
        'as' => 'sugerencias.create'
    ]);
    
    Route::post('/sugerencias/store', [
        'uses' => 'SugerenciasController@store',
        'as' => 'sugerencias.store'
    ]);

    Route::get('/foro/create/{id}', [
        'uses' => 'ForoController@create',
        'as' => 'foro.create'
    ]);

    Route::post('/foro/store', [
        'uses' => 'ForoController@store',
        'as' => 'foro.store'
    ]);

    Route::get('/foro/{id}/comentar', [
        'uses' => 'ForoController@index',
        'as' => 'foro.index'
    ]);

    Route::post('/foro/{id}/comentar', [
        'uses' => 'ForoController@comentar',
        'as' => 'foro.comentar'
    ]);
});

Route::get('/foro', [
    'uses' => 'ForoController@index',
    'as' => 'foro.index'
]);

Route::get('/foro/tema/{id}', [
    'uses' => 'ForoController@tema',
    'as' => 'foro.tema'
]);