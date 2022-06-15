<?php

use App\Http\Controllers\TasksController;
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
Route::middleware('auth:api')->prefix('v1')->group(function() {
    Route::get('/user', function(Request $request){
        return $request->user();
    });

    Route::apiResource('/tasks', TasksController::class);

    // Route::get('/tasks/{task}', [TasksController::class, 'show']);
    // Route::get('/tasks', [TasksController::class, 'index']);
});



// Rota padrão antiga
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
