<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\RouteGroup;
use App\Models\User;
use App\Http\Controllers\API\UserController;
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
Route::post('/login', [ App\Http\Controllers\API\UserController::class, 'login']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return Auth::user();
});
Route::get('users', function(){
    return User::all();
});

Route::middleware('auth:api')->prefix('profile')->group(function () {
    Route::get('user/logout', [ App\Http\Controllers\API\UserController::class, 'logout'])->middleware('auth');
    Route::get('user/videos/{id}', [ App\Http\Controllers\API\VideosController::class, 'obtenerVideo']);
});

/* REFERENCIAS no borrar
Route::group(['prefix' => 'auth'], function ()  {
    Route::post('/register', [ App\Http\Controllers\API\UserController::class, 'register']);
    Route::post('/login', [ App\Http\Controllers\API\UserController::class, 'login']);
    Route::group(['middleware' => 'auth:api'], function (){
        Route::get('user/logout', 'UserController@logout');
    });
    Route::group(['middleware' => 'auth:api'], function (){
    Route::get('user/logout', [ App\Http\Controllers\API\UserController::class, 'logout'])->middleware('auth');
});
});*/





