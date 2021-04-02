<?php

use App\Http\Controllers\DetalleController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\RolController;
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
//http://127.0.0.1:8000/api/p1/producto
Route::group(['prefix' => 'p1'], function () {
    Route::group(['prefix' => 'producto'], function () {
        //Ruta de tipo
        Route::group([
            'prefix' => 'tipo'
        ], function ($router) {
            Route::get('', [TipoController::class, 'index']);
        });

        //Ruta de Reservas
        Route::group([
            'prefix' => 'reserva'
        ], function ($router) {
            Route::get('', [ReservaController::class, 'index']);
        });

        //Ruta de Rol
        Route::group([
            'prefix' => 'rol'
        ], function ($router) {
            Route::get('', [RolController::class, 'index']);
        });

        //Ruta de Detalle
        Route::group([
            'prefix' => 'detalle'
        ], function ($router) {
            Route::get('', [DetalleController::class, 'index']);
        });


        Route::get('', [ProductoController::class, 'index']);
        Route::get('/{id}', [ProductoController::class, 'show']);

        //Productos
        Route::post('', [ProductoController::class, 'store']);
        Route::patch(
        '/{id}',
        [
            ProductoController::class,
            'update'
        ]
        );


});

});
