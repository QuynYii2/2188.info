<?php

// User
use App\Http\Controllers\Admin\AdminUserController;

Route::prefix('user')->group(function () {
    Route::get('/list-users', [AdminUserController::class, 'listUser'])->name('admin.list.users');
    Route::get('/detail-users/{id}', [AdminUserController::class, 'detail'])->name('admin.detail.users');
    Route::put('/edit-users/{id}', [AdminUserController::class, 'edit'])->name('admin.edit.users');
    Route::get('/private-update-users/{id}', [AdminUserController::class, 'processUpdate'])->name('admin.private.update.users');
    Route::put('/update-users/{id}', [AdminUserController::class, 'update'])->name('admin.update.users');

    Route::get('/create-users', [AdminUserController::class, 'processCreate'])->name('admin.processCreate.users');
    Route::post('/create-users', [AdminUserController::class, 'create'])->name('admin.create.users');

    Route::delete('/delete-users/{id}', [AdminUserController::class, 'delete'])->name('admin.delete.users');
    Route::get('/detail-users-company/{id}', [AdminUserController::class, 'showCompany'])->name('admin.detail.users.company');
    Route::put('/edit-users-company/{id}', [AdminUserController::class, 'updateCompany'])->name('admin.edit.users.company');
});