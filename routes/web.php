<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

Route::view('news', 'news.news')->name('news.view');

// Admin Group
Route::middleware(['auth'])->group(function () {
    Route::middleware(['ensureUserHasRole:users_moderator'])->group(function () {
        Route::view('manage/users', 'admin.users-manager')->name('users.view');
    });
    
    Route::middleware(['ensureUserHasRole:roles_moderator'])->group(function () {
        Route::view('manage/roles', 'admin.roles-manager')->name('roles.view');
    });
});
