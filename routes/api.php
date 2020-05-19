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
            ->middleware(['user.admin']);

        Route::delete('logout', 'Auth\LoginController@logout')
            ->middleware(['auth:api']);

        Route::post('login', 'Auth\LoginController@login');
    });

    /**
     * Instituciones
     */

    Route::middleware('auth:api')->group(function () {
        Route::resource('media', 'Media\CrudController');

        Route::resource('institutions', 'Institutions\CrudController', [
            'only' => ['index', 'show']
        ]);

        Route::resource('users', 'Users\CrudController', [
            'only' => ['index', 'show']
        ]);

        Route::resource('staff', 'Staff\CrudController', [
            'only' => ['index', 'show']
        ]);

        Route::resource('patients', 'Patients\CrudController', [
            'only' => ['index', 'show']
        ]);

        Route::resource('retrieved', 'FormsValues\CrudController',
            [
                'only' => ['index', 'show']
            ]);
    });

    /**
     * Rutas con nivel admin manager y admin
     */

    Route::middleware(['auth:api', 'user.manager'])->group(function () {
        Route::resource('institutions', 'Institutions\CrudController',
            [
                'only' => ['store', 'update', 'destroy']
            ]);

        Route::resource('staff', 'Staff\CrudController',
            [
                'only' => ['store', 'update', 'destroy']
            ]);

        Route::resource('patients', 'Patients\CrudController',
            [
                'only' => ['store', 'update', 'destroy']
            ]);

        Route::resource('retrieved', 'FormsValues\CrudController',
            [
                'only' => ['store', 'update', 'destroy']
            ]);

        Route::resource('forms', 'Forms\CrudController',
            [
                'only' => ['index', 'show', 'edit']
            ]);
    });

    /**
     * Rutas con nivel solo admin
     */

    Route::middleware(['auth:api', 'user.admin'])->group(function () {
        Route::resource('users', 'Users\CrudController',
            [
                'only' => ['store', 'update', 'destroy']
            ]);

        Route::resource('forms', 'Forms\CrudController',
            [
                'only' => ['store', 'update', 'destroy']
            ]);
    });

});

