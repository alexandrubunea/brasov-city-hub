<?php

use App\Http\Controllers\RichTextEditorController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

Route::view('news', 'news.news')->name('news.view');
Route::view('news/article/{id}', 'news.article')->name('news.article');

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

    // Rich Text Editor Access
    Route::middleware(['ensureUserHasRole:news_creator,news_moderator'])->group(function () {
        Route::post('/tinymce/upload', [RichTextEditorController::class, 'upload'])->name('rich-text-editor.upload');
    });
    Route::middleware(['ensureUserHasRole:news_creator,news_moderator'])->group(function () {
        Route::view('news/edit-article/{id}', 'news.edit-article')->name('news.edit');
    });
});

