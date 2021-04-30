<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web ro+utes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

   Route::middleware(['admin'])->group(function (){

   Route::get('/admin','Admin\LoginController@login');
   Route::post('/admin','Admin\LoginController@dologin');
   Route::get('/admin/logout','Admin\LoginController@logout');


   // admin dashboard
   Route::get('/admin/DashBoard','Admin\DashboardController@index'); 

     //blog 
   Route::get('/admin/Blog','Admin\BlogController@index'); 
   Route::get('/admin/Blog/add','Admin\BlogController@create'); 
   Route::post('/admin/Blog/save', 'Admin\BlogController@store');
   Route::get('/admin/Blog/edit/{id}','Admin\BlogController@edit');	
   Route::post('/admin/Blog/edit-save','Admin\BlogController@update');
   Route::delete('/admin/Blog/delete/{id}','Admin\BlogController@delete');			


 });



   