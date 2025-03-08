<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;




Route::get('/list-property-front', [PropertyController::class, 'index']);
Route::get('/single-property-front/{id}', [PropertyController::class, 'show']);
