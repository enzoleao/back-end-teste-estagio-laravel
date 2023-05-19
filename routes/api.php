<?php
Use App\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
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

Route::get('companies', [CompaniesController:: class, 'index']);
Route::get('companies/{id}', [CompaniesController:: class, 'show']);
Route::post('companies', [CompaniesController:: class, 'store']);
Route::put('companies/{id}', [CompaniesController:: class, 'update']);
Route::delete('companies/{id}', [CompaniesController:: class, 'delete']);
