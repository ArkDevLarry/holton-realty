<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ShortletController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('isban')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard', ['pg'=>"Dashboard"]);
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::middleware('auth')->prefix('admin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
        Route::get('/create-admin', [UserController::class, 'create'])->name('create-admin');
        Route::get('/manage-admin', [UserController::class, 'index'])->name('manage-admin');
        Route::patch('/status/{id}', [UserController::class, 'status'])->name('admin.status');
        Route::resource('admin', UserController::class);
    
        Route::get('/manage-property', [PropertyController::class, 'index'])->name('manage-property');
        Route::patch('/property-status/{uniqId}', [PropertyController::class, 'status'])->name('property-status');
        Route::get('/create-property', [PropertyController::class, 'create'])->name('create-property');
        Route::post('/create-property', [PropertyController::class, 'store'])->name('create-property');
        Route::get('/update-property/{id}', [PropertyController::class, 'edit'])->name('update-property');
        Route::post('/update-property/{id}', [PropertyController::class, 'update'])->name('update-property');
        Route::post('/update-property-images/{id}', [PropertyController::class, 'updateImages'])->name('update-property-images');
        Route::resource('property', PropertyController::class);


        Route::get('/manage-shortlet', [ShortletController::class, 'index'])->name('manage-shortlet');
        Route::patch('/shortlet-status/{uniqId}', [ShortletController::class, 'status'])->name('shortlet-status');
        Route::get('/create-shortlet', [ShortletController::class, 'create'])->name('create-shortlet');
        Route::post('/create-shortlet', [ShortletController::class, 'store'])->name('create-shortlet');
        Route::get('/update-shortlet/{id}', [ShortletController::class, 'edit'])->name('update-shortlet');
        Route::post('/update-shortlet/{id}', [ShortletController::class, 'update'])->name('update-shortlet');
        Route::post('/update-shortlet-images/{id}', [ShortletController::class, 'updateImages'])->name('update-shortlet-images');
        Route::resource('shortlet', ShortletController::class);
    
    });
});

require __DIR__.'/auth.php';
