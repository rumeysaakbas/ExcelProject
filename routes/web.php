<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use App\Jobs\ExcelImportJob;
use Illuminate\Support\Facades\Excel;


Route::get('/', [ExcelController::class, 'index']);
Route::post('/import', [ExcelController::class, 'import'])->name('import');

