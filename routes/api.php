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
Route::post('/register', [ App\Http\Controllers\API\UserController::class, 'register']);

Route::middleware('auth:api')->prefix('profile')->group(function () {
    Route::post('/register', [ App\Http\Controllers\API\UserController::class, 'register']);
});
