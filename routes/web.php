<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

Route::view('manage/roles', 'admin.roles-manager')->name('roles.view');
Route::view('manage/users', 'admin.users-manager')->name('users.view');
