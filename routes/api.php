<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//route untuk get all
Route::get('/employees', [EmployeeController::class,'index']);

//route untuk menambahkan data
Route::post('/employees', [EmployeeController::class,'store'])->middleware('auth:sanctum');

//route untuk mendapatkan data tertentu
Route::get('/employees/{id}', [EmployeeController::class,'show']);

//route untuk mengupdate data
Route::put('/employees/{id}', [EmployeeController::class,'update'])->middleware('auth:sanctum');

//route untuk menghapus data
Route::delete('/employees/{id}', [EmployeeController::class,'destroy'])->middleware('auth:sanctum');

//route untuk menampilkan data by name
Route::get('/employees/search/{name}', [EmployeeController::class, 'search']);

//route untuk menampilkan data active
Route::get('/employees/status/active', [EmployeeController::class, 'active']);

//route untuk menampilkan data inactive
Route::get('/employees/status/inactive', [EmployeeController::class, 'inactive']);

//route untuk menampilkan data terminate
Route::get('/employees/status/terminated', [EmployeeController::class, 'terminated']);


Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);