<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PracownicyController;
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
Route::post('logowanie',[UserController::class,'login']);
Route::post('rejestracja',[UserController::class,'rejestracja']);
Route::get('get_us',[UserController::class,'get_us']);
Route::post('wyloguj',[UserController::class,'wyloguj'])->middleware('auth:sanctum');
Route::group(['middleware' => ['auth:sanctum','role:Kierownik']], function () {
Route::get('sru',[UserController::class,'searchuser']);
Route::get('show',[UserController::class,'show_user']);
Route::get('zlecenia', [PracownicyController::class, 'zlecenia']);
Route::get('getdod', [PracownicyController::class, 'getdod']);
Route::get('getrole', [UserController::class, 'get_role']);
Route::delete('usun', [PracownicyController::class, 'usun']);
Route::post('dodawanie', [PracownicyController::class, 'dodawanie']);
Route::get('edytowanie/{id}', [PracownicyController::class, 'edytowaniezlecen']);
Route::post('update/{id}', [PracownicyController::class, 'update']);
Route::get('zs', [PracownicyController::class, 'zsearch']);
});
