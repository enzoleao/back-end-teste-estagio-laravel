<?php
Use App\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\SectorsController;


Route::get('companies', [CompaniesController:: class, 'index']);
Route::get('companies/{companyInitials}', [CompaniesController:: class, 'search']);Route::get('companies/{companyInitials}', [CompaniesController:: class, 'search']);
Route::post('companies', [CompaniesController:: class, 'store']);
Route::put('companies/{id}', [CompaniesController:: class, 'update']);
Route::delete('companies/{id}', [CompaniesController:: class, 'delete']);

Route::get('sectors', [SectorsController:: class, 'index']);
Route::get('sectors/{id}', [SectorsController:: class, 'show']);

Route::get('search/{sectorsInitials}', [CompaniesController:: class, 'searchBySec']);
