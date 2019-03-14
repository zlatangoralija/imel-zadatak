<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//Ruta koja vraća početnu stranicu
Route::get('/', function () {
    return view('welcome');
});
//Dodatna ruta koja korisnika obavještava o uspješnoj registraciji
Route::get('/register-info', function (){
    return view('register');
});
//Helper autentifikaciona ruta koja unaprijed kreira sve potrebne rute za registraciju, prijavu, odjavu korisnika
Route::auth();
Route::get('/logout', 'Auth\LoginController@logout'); //Naknadna ruta za odjavu, jer preko auth() ruta se javlja MethodNoTAllowed() error
//Dodajemo novu grupu ruta, koje će na sebi imati middleware admin koji provjerava da li korisnik ima role admin
Route::group(['middleware'=>'admin'], function (){
    Route::get('/admin', function(){
        return view('admin.index');
    });
    //Resource rute koje dolaze sa unaprijed definisanim rutama za create, update, destroy..., te posebna imena za rute radi lakšeg pristupa
    Route::resource('admin/users', 'AdminUserController', ['names'=>[
        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'edit'=>'admin.users.edit',
        'store'=>'admin.users.store',
    ]]);
    Route::resource('admin/posts', 'AdminPostsController', ['names'=>[
        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'edit'=>'admin.posts.edit',
        'store'=>'admin.posts.store',
    ]]);
    Route::resource('admin/categories', 'AdminCategoriesController', ['names'=>[
        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'edit'=>'admin.categories.edit',
        'store'=>'admin.categories.store',
    ]]);
    //Ruta koja vraća view pojedinačnog posta koristeći njegov ID
    Route::get('/post/{id}',  ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);
});
