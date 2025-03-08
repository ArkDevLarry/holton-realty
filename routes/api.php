<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;




Route::get('/list-property-front', [PropertyController::class, 'index'])->name('manage-property');
Route::get('/single-property-front/{id}', [PropertyController::class, 'show'])->name('manage-property');
