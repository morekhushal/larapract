<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanDetailController;

Route::redirect('/', 'login');;

Route::match(['GET', 'POST'], 'login', [UserController::class, 'login'])->name('login');
Route::get('loan-details', [LoanDetailController::class, 'loanDetails'])->name('loan-details');
// Route::get('load-loan-details', [AdminController::class, 'loadLoanDetails'])->name('load-loan-details');
Route::get('process_data', [LoanDetailController::class, 'processData'])->name('process_data');
Route::get('load-processed-data', [LoanDetailController::class, 'loadProcessData'])->name('load-processed-data');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
