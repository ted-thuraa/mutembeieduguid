<?php

use App\Http\Controllers\Api\AdminDashController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\ReviewsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\UserResource;


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

Route::middleware(['guest'])->group(function () {
    Route::post('/register', [AuthController::class, 'store']);
   
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verify-email-token', [AuthController::class, 'verifyemail']);
                
});





                

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });
    Route::patch('users/{user}', [UserController::class, 'update']);
    Route::post('/userdetails', [AuthController::class, 'storeDetails']);
    Route::get('/getresource', [ResourceController::class, 'getResources']);
    Route::get('/getreview/{id}', [ReviewsController::class, 'getreviews']);
    Route::post('/newreview', [ReviewsController::class, 'saveReview']);
    Route::post('/logout', [AuthController::class, 'logout']);
    //payments stuff
    
});


//admin side
Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index']);
    Route::get('/admin/getresource', [ResourceController::class, 'index']);
    Route::post('/admin/newresource', [ResourceController::class, 'store']);
    Route::post('/admin/updateresource/{id}', [ResourceController::class, 'update']);
    Route::delete('/admin/resource/{id}', [ResourceController::class, 'destroy']);
    Route::get('/admin/analytics', [AdminDashController::class, 'index']);

});
