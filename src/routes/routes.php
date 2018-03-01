<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//  return view('threads.welcome');
//});
Route::group(['middleware' => 'api', 'prefix' => 'api', 'namespace' => '\\Greygonz\\Threads\\Controllers', 'mddleware' => ['throttle', 'bindings']], function () {
  Route::resource('/threads', 'ApiThreadsController');
});

Route::group(['middleware' => 'web', 'namespace' => '\\Greygonz\\Threads\\Controllers'], function () {
  Route::group(['middleware' => 'auth:web'], function () {
    Route::resource('/threads', 'ThreadsController');
  });
});
