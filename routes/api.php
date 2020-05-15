<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => '1.0'], function () {


    /**
     * Grupo de auth
     */
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'Auth\LoginController@signup')
            ->middleware(['user.check']);

        Route::delete('logout', 'Auth\LoginController@logout')
            ->middleware(['auth:api']);

        Route::post('login', 'Auth\LoginController@login');
    });

    /**
     * Instituciones
     */
    Route::middleware('auth:api')->group(function () {
        Route::resource('institutions', 'Institutions\CrudController', [
            'only' => ['index', 'show']
        ]);
    });

    /**
     * Rutas con nivel admin dios
     */
    Route::middleware(['auth:api', 'user.check'])->group(function () {
        Route::resource('institutions', 'Institutions\CrudController',
            [
                'only' => ['store', 'update','destroy']
            ]);
    });

});

