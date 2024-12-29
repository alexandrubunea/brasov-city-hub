<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

// Admin Group
Route::middleware(['auth'])->group(function () {
    Route::middleware(['ensureUserHasRole:users_moderator,roles_moderator'])->group(function () {
        Route::view('manage/users', 'admin.users-manager')->name('users.view');
    });
    
    Route::middleware(['ensureUserHasRole:roles_moderator'])->group(function () {
        Route::view('manage/roles', 'admin.roles-manager')->name('roles.view');
    });
});
