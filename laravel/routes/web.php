<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
require __DIR__.'/auth.php';
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');