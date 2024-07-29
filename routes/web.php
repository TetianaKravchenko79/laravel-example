<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){ //!!!route('login')
    return redirect(route('login'));
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
                              
Route::get('/link-change-password', 'Auth\ForgotPasswordController@linkChangePassword')->name('link-change-password');
Route::post('/change-password', 'Auth\ForgotPasswordController@changePassword')->name('change-password');
Route::get('/home', 'ProductController@index')->name('home');
Route::get('/product/{id}', 'ProductController@product')->name('product'); //product/{id}/{name}

Route::get('/product/{id}/comment', 'ProductController@comment')->name('comment');
Route::post('/addcomment', 'ProductController@addcomment')->name('addcomment');
Route::post('/removecomment', 'ProductController@removecomment')->name('removecomment');


Route::get('/cart', 'ProductController@cart')->name('cart');
// Route::get('/cart', 'ProductController@cart')->name('cart')->middleware('auth');
Route::post('/tocart', 'ProductController@tocart')->name('tocart');
Route::post('/clearall', 'ProductController@clearall')->name('clearall');
Route::post('/clearone', 'ProductController@clearone')->name('clearone');
Route::post('/mailer', 'ProductController@mailer')->name('mailer');

// Route::get('/dashboard', 'AdminController@index')->name('dashboard');

});

Route::middleware('admin')->group(function () {
   
    
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::name('users')->resource('users', 'AdminController');
    
    });