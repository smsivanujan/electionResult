<?php

use App\Http\Controllers\ElectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ElectionController::class, 'index']);
Route::get('/uploadAdmin', [ElectionController::class, 'indexUpload']);
Route::post('/upload', [ElectionController::class, 'store']);
Route::delete('/delete/{id}', [ElectionController::class, 'destroy'])->name('results.destroy');
