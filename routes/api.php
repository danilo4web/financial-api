<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('v1/accounts', [App\Http\Controllers\API\AccountController::class, 'createAccount']);
Route::post('v1/transfer', [App\Http\Controllers\API\TransactionController::class, 'transfer']);
Route::get('v1/accounts/balance/{accountId}', [App\Http\Controllers\API\AccountController::class, 'balance']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
