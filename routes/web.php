<?php

use Illuminate\Support\Facades\Artisan;
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


Route::get('/db', function () {
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('db:seed');
    Artisan::call('passport:install ');
});

Route::get('/test', function () {
    return view('reports.declaration');
});
