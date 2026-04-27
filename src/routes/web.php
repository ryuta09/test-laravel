<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello, World!!!!';
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/company', function () {
    return view('company');
});

Route::get('/user/{id}', function ($id) {
    return 'ユーザーID: ' . $id;
});

Route::get('/post/{category}/{id}', function ($category, $id) {
    return "カテゴリ: {$category}, 記事ID: {$id}";
});

Route::get('/greeting/{name?}', function ($name = 'ゲスト') {
    return "こんにちは、{$name}さん";
});

// ルートに名前をつける
Route::get('/profile/user', function () {
    return 'プロフィールページ';
})->name('profile');

// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', function () {
//         return '管理画面ダッシュボード';
//     });
//     Route::get('/users', function () {
//         return 'ユーザー管理';
//     });
//     Route::get('/posts', function () {
//         return '記事管理';
//     });
// });

// ルートにプレフィックスをつける
Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('/dashboard', function () {
      return '管理画面ダッシュボード';
  })->name('dashboard');  // ルート名: admin.dashboard

  Route::get('/users', function () {
      return 'ユーザー管理';
  })->name('users');      // ルート名: admin.users
});