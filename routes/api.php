<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/generate-report', [ReportController::class, 'generateReport']);

Route::get('/get-report/{id}', [ReportController::class, 'getReport']);

Route::get('/list-reports', [ReportController::class, 'listReport']);
