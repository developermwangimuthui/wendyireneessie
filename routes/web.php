
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
Route::get('/', 'HomeController@redirectPlayStore')->name('redirectPlayStore');



Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});




Auth::routes();

// Route::get('/meme/{id}', function () {
//    return Redirect::to('https://play.google.com/store/apps/details?id=com.trichain.kenyasihami');
// });
Route::get('/meme/{id}','HomeController@redirectPlayStore')->name('redirectPlayStore');

Route::group(['middleware' => 'auth'], function () {
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

    // ..................Reported Posts..............................//

    Route::get('/reported/memes/', 'HomeController@reportedMemes')->name('reportedMemes');

    // ..................Reported Users..............................//

    Route::get('/reported/users/', 'HomeController@reportedUsers')->name('reportedUsers');

    Route::delete('/user/destroy/', 'HomeController@userDestroy')->name('user.destroy');


    // ..................Rbac..............................//

    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');



});
Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return 'Success';
    // return what you want
});
Route::get('/config/cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'Success';
    // return what you want
});
Route::get('/key/generate', function () {
    $exitCode = Artisan::call('key:generate');
    return 'Success';
    // return what you want
});
Route::get('/cache/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    return 'Success';
    // return what you want
});
Route::get('/config/clear', function () {
    $exitCode = Artisan::call('config:clear');
    return 'Success';
    // return what you want
});
Route::get('/route/clear', function () {
    $exitCode = Artisan::call('route:clear');
    return 'Success';
    // return what you want
});
Route::get('/db/seed', function () {
    $exitCode = Artisan::call('db:seed');
    return 'Success';
    // return what you want
});