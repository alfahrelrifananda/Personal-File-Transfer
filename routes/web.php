<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

Route::get('/', [FileController::class, 'index'])->name('files.index');
Route::post('/upload', [FileController::class, 'upload'])->name('files.upload');
Route::get('/download/{file}', [FileController::class, 'download'])->name('files.download');
Route::delete('/delete/{file}', [FileController::class, 'delete'])->name('files.delete');
