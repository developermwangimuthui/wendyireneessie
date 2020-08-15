
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true, 'register' => false,'login' => false]);
Route::match(['get', 'post'], 'login', function(){
    return redirect('/');
});

Route::get('/', 'HomeController@redirectPlayStore')->name('redirectPlayStore');



Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});




Auth::routes();

Route::get('/meme/{id}', function () {
   return Redirect::to('https://play.google.com/store/apps/details?id=com.trichain.kenyasihami');
});



Route::get('/home', 'HomeController@dashboard')->name('home');
Route::get('/memes/index', 'HomeController@index')->name('memes.index');
Route::post('/memes/store', 'HomeController@store')->name('memes.store');
Route::get('/memes/edit/{id}', 'HomeController@edit')->name('memes.edit');
Route::post('/memes/update/{id}', 'HomeController@update')->name('memes.update');
Route::get('/memes/details/{id}', 'HomeController@memesDetails')->name('memes.details');
Route::delete('/memes/destroy/', 'HomeController@memeDestroy')->name('memes.destroy');
Route::delete('/photo/destroy/', 'HomeController@photoDestroy')->name('photo.destroy');
Route::get('/meme-show/{id}', 'HomeController@memeShow')->name('memeShow');


// ..................Slider..............................//
Route::get('/slider/index', 'SliderController@index')->name('slider.index');
Route::post('/slider/store', 'SliderController@store')->name('slider.store');
Route::get('/slider/edit/{id}', 'SliderController@edit')->name('slider.edit');
Route::post('/slider/update/{id}', 'SliderController@update')->name('slider.update');
Route::delete('/slider/destroy/', 'SliderController@destroy')->name('slider.destroy');
// Route::get('/passport/install', function () {
//     $exitCode = Artisan::call('passport:install');
//     return 'Success';
//     // return what you want
// });