<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/registration',[AuthController::class,'register']);
Route::middleware('auth:sanctum')->get('/profile',[AuthController::class,'profile']);
