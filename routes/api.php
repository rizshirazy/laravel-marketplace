<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\AddressController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/check', [UserController::class, 'check'])->name('api.register.check');

Route::get('provices', [AddressController::class, 'provinces'])->name('api.provinces');
Route::get('regencies/{province_id?}', [AddressController::class, 'regencies'])->name('api.regencies');
