<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AccessController;
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

Route::post('loan', [LoanController::class, 'store']);

/*
 * Authentication routes
 */

Route::post('register', [AccessController::class, 'register']);
Route::post('login', [AccessController::class, 'login' ]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
    Route::post('logout', [ AccessController::class, 'logout' ]);
    Route::get('loans', [ LoanController::class, 'index' ]);
    Route::get('loans/{loan}', [ LoanController::class, 'show' ]);
});
Route::fallback(function (){
    return response(['message'=>'Not Found'], 404);
});
