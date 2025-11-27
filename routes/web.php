<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WhatsappHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('items', ItemController::class);
    Route::resource('students', StudentController::class);

    Route::get('/dashboard', [BorrowController::class, 'index'])->name('borrows.index');
    Route::get('/borrows/form', [BorrowController::class, 'borrow'])->name('borrows.form');
    Route::post('/borrows', [BorrowController::class, 'store'])->name('borrows.store');
    Route::post('/borrows/{id}/return', [BorrowController::class, 'returnItem'])->name('borrows.return');
    Route::delete('/borrows/{id}', [BorrowController::class, 'destroy'])->name('borrows.destroy');

    Route::get('/whatsapp-histories', [WhatsappHistoryController::class, 'index'])->name('whatsapp-histories.index');
    Route::delete('/whatsapp-histories/{id}', [WhatsappHistoryController::class, 'destroy'])->name('whatsapp-histories.destroy');

    Route::prefix('approvals')->group(function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('approval.index');
        Route::post('/{id}/approve', [ApprovalController::class, 'approve'])->name('approval.approve');
        Route::post('/{id}/reject', [ApprovalController::class, 'reject'])->name('approval.reject');
    });
    
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
});
