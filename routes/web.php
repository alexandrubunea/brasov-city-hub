<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

Route::view('roles', 'admin.roles-manager')->name('roles.view');
