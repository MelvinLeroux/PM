<?php

use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\MonthlyRevenueController;
use App\Http\Controllers\TopCustomerController;
use App\Http\Controllers\TopProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/import', [CsvImportController::class, 'import']);
Route::get('/report/topproducts/{top?}', [TopProductController::class, 'topProductsByRevenue']);
Route::get('/report/monthly-revenue/{year}', [MonthlyRevenueController::class, 'monthlyRevenue']);
Route::get('/report/top-customers/{top?}', [TopCustomerController::class, 'topCustomersByRevenue']);
