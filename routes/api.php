<?php

use App\Http\Controllers\Api\ApiApprovalController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiBorrowController;
use App\Http\Controllers\Api\ApiItemController;
use App\Http\Controllers\Api\ApiStudentController;
use App\Http\Controllers\Api\ApiWhatsappHistoryController;
use App\Http\Controllers\Api\RFIDController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/rfid-user', [RFIDController::class, 'index']);
Route::get('/find-by-card', [RFIDController::class, 'findByCard']);
Route::get('/rfid', [RFIDController::class, 'store']);

Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout']);

Route::apiResource('/items', ApiItemController::class);
Route::apiResource('/students', ApiStudentController::class);
Route::apiResource('/borrows', ApiBorrowController::class);

Route::get('/whatsapp-histories', [ApiWhatsappHistoryController::class, 'index']);
Route::get('/whatsapp-histories/{id}', [ApiWhatsappHistoryController::class, 'show']);
Route::delete('/whatsapp-histories/{id}', [ApiWhatsappHistoryController::class, 'destroy']);

Route::prefix('approvals')->group(function () {
    Route::get('/', [ApiApprovalController::class, 'index']);
    Route::post('/{id}/approve', [ApiApprovalController::class, 'approve']);
    Route::post('/{id}/reject', [ApiApprovalController::class, 'reject']);
});