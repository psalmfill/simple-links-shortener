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

Route::get('/', function () {
    return redirect()->route('links.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('links','LinksController');
Route::get('/{id}',function ($short_link){
    $link = \App\Link::where('short_link',$short_link)->first();
    if ($link){

        return redirect()->route('links.show',$link->id);
    }
    return abort(404);
});