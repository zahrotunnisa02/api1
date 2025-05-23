<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Autentikasi;
use App\Http\Resources\StudentRsc;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [Autentikasi::class, 'register']);
Route::post('/login', [Autentikasi::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [Autentikasi::class, 'logout']);
    Route::get('/me', [Autentikasi::class, 'me']);
    Route::apiResource('/students', StudentController::class);
});