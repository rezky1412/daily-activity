<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserConfigController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\ProgresApprovalController;
use App\Http\Controllers\VPApprovalController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');    
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/user-config', [UserConfigController::class, 'index'])->name('user.config');
    Route::get('/user-config/create', [UserConfigController::class, 'create'])->name('user.config.create');
    Route::post('/user-config', [UserConfigController::class, 'store'])->name('user.config.store');
    Route::get('/user-config/{user}/edit', [UserConfigController::class, 'edit'])->name('user.config.edit');
    Route::put('/user-config/{user}', [UserConfigController::class, 'update'])->name('user.config.update');
    Route::delete('/user-config/{user}', [UserConfigController::class, 'destroy'])->name('user.config.destroy');
});

Route::middleware(['auth', 'role:Officer'])->group(function () {
    Route::get('/progres', [ProgresController::class, 'index'])->name('progres.index');
    Route::get('/progres/create', [ProgresController::class, 'create'])->name('progres.create');
    Route::post('/progres', [ProgresController::class, 'store'])->name('progres.store');
    Route::get('/progres/{id}', [ProgresController::class, 'show'])->name('progres.show');
    Route::get('/progres/{progres}/edit', [ProgresController::class, 'edit'])->name('progres.edit');
    Route::put('/progres/{progres}', [ProgresController::class, 'update'])->name('progres.update');
});

Route::middleware(['auth', 'role:PM'])->prefix('approval')->group(function () {
    Route::get('/', [ProgresApprovalController::class, 'index'])->name('approval.index');
    Route::post('/{id}/approve', [ProgresApprovalController::class, 'approve'])->name('approval.approve');
    Route::post('/{id}/reject', [ProgresApprovalController::class, 'reject'])->name('approval.reject');
});

Route::middleware(['auth', 'role:VP QHSE'])->prefix('vp-approval')->group(function () {
    Route::get('/', [VPApprovalController::class, 'index'])->name('vp.approval.index');
    Route::post('/{id}/approve', [VPApprovalController::class, 'approve'])->name('vp.approval.approve');
    Route::post('/{id}/reject', [VPApprovalController::class, 'reject'])->name('vp.approval.reject');
});

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'role:Admin'])->prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

require __DIR__.'/auth.php';
