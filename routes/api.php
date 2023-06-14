<?php

use App\Http\Controllers\API\PrimeController;
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

Route::get('get_token',[PrimeController::class,'login'])->name('login');
Route::post('get_token',[PrimeController::class,'login'])->name('login_new');
Route::middleware('auth:sanctum')->post('check_merchant',[PrimeController::class, 'check_merchant'])->name('check_merchant');
Route::middleware('auth:sanctum')->post('merchant_registration',[PrimeController::class, 'merchant_registration'])->name('merchant_registration');
Route::middleware('auth:sanctum')->post('get_service_fee_percentage',[PrimeController::class, 'get_service_fee_percentage'])->name('get_service_fee_percentage');
Route::middleware('auth:sanctum')->post('edit_merchant_profile',[PrimeController::class, 'edit_merchant_profile'])->name('edit_merchant_profile');
Route::middleware('auth:sanctum')->post('edit_service_fee_percentage',[PrimeController::class, 'edit_service_fee_percentage'])->name('edit_service_fee_percentage');
Route::middleware('auth:sanctum')->post('update_setting',[PrimeController::class, 'update_setting'])->name('update_setting');
Route::middleware('auth:sanctum')->post('get_setting',[PrimeController::class, 'get_setting'])->name('get_setting');

