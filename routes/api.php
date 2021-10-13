<?php

use App\Http\Controllers\API\LoginController;
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

Route::post('login', function () {
    auth()->attempt(['email' => 'jelenavuc@gmail.com', 'password' => '12345678']);
    $success = ['token' => auth()->user()->createToken('API Token')->plainTextToken];
    return $success;
});

Route::middleware('auth:sanctum')->get('/test', function (Request $request) {
    return $request->user();
});
