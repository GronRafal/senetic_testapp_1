<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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
Route::middleware(['basicAuth'])->group(function () {
    Route::get('customers', [ApiController::class, 'getAllCustomers']);
    Route::get('customer/{id}', [ApiController::class, 'getCustomer']);
    Route::post('customer', [ApiController::class, 'createCustomer']);
    Route::put('customer/{id}', [ApiController::class, 'updateCustomer']);
    Route::delete('customer/{id}', [ApiController::class, 'deleteCustomer']);
    Route::get('customer/{id}/addresses', [ApiController::class, 'getAllAddresses']);
    Route::get('address/{id}', [ApiController::class, 'getAddress']);
    Route::post('customer/{id}/address', [ApiController::class, 'createAddress']);
    Route::put('address/{id}', [ApiController::class, 'updateAddress']);
    Route::delete('address/{id}', [ApiController::class, 'deleteAddress']);
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
