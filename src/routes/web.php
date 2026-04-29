<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/post/{category}/{id}', function ($category, $id) {
    return "カテゴリ: {$category}, 記事ID: {$id}";
});

// Route::get('/greeting/{name?}', function ($name = 'ゲスト') {
//     return "こんにちは、{$name}さん";
// });

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

// routes/web.php
Route::get('/hello', function () {
    $text = 'Laravel';
    return view('hello', compact('text'));
});
// Route::get('/greeting', function () {
//     return view('greeting', ['name' => '太郎']);
// });

// Route::get('/greeting', function () {
//     return view('greeting')->with('name', '佐藤');
// });

Route::get('/greeting', function () {
    $age = 31;

    return view('greeting', compact('age'));
});

Route::get('/xss-demo', function () {
    // 攻撃者が入力したコメント（本来はフォームから受け取る）
  $comment = '<strong>太字</strong>のテキスト';

    return view('xss-demo', compact('comment'));
});

Route::get('/layout/home', function () {
    return view('pages.home');
});

Route::get('/layout/about', function () {
    return view('pages.about');
});

Route::get('/layout/contact', function () {
    return view('pages.contact');
});

Route::get('/component-demo', function () {
    return view('component-demo');
});

Route::resource('users', UserController::class);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::get('/products/{id}', [ProductController::class, 'show']);