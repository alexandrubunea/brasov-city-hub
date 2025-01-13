<?php

use App\Http\Controllers\RichTextEditorController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

Route::view('news', 'news.news')->name('news.view');

Route::middleware(['auth'])->group(function () {
    // Admin Group
    Route::middleware(['ensureUserHasRole:users_moderator'])->group(function () {
        Route::view('manage/users', 'admin.users-manager')->name('users.view');
    });

    Route::middleware(['ensureUserHasRole:roles_moderator'])->group(function () {
        Route::view('manage/roles', 'admin.roles-manager')->name('roles.view');
    });

    // News Creator Group
    Route::middleware(['ensureUserHasRole:news_creator'])->group(function() {
        Route::view('news/create-article', 'news.create-article')->name('news.create');
    });

    // Editor Access
    Route::middleware(['ensureUserHasRole:news_creator,news_editor'])->group(function () {
        Route::post('/tinymce/upload', [RichTextEditorController::class, 'upload'])->name('rich-text-editor.upload');
    });
});
