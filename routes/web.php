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

Route::get('/','HomepageController@index')->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/quiz/{slug}','TestsController@show')->name('test.show');

Route::get('/about','HomepageController@about')->name('about');
Route::get('/contact','HomepageController@contact')->name('contact');
Route::get('/privacy-policy','HomepageController@privacyPolicy')->name('privacy-policy');

Route::post('/contact','MessagesController@store')->name('contact_us_submit');