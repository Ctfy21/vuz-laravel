<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;


Route::group(['prefix'=>'/article', 'middleware'=>'auth:sanctum'], function(){
    Route::get('/create',[ArticleController::class, 'create']);
    Route::post('/store',[ArticleController::class, 'store']);
    Route::get('/{articleId}', [ArticleController::class, 'view'])->name('show');
    Route::put('/{articleId}', [ArticleController::class, 'update']);
    Route::get('/{articleId}/delete', [ArticleController::class, 'destroy']);
    Route::get('/{articleId}/edit', [ArticleController::class, 'edit']);
});

Route::get('/', [MainController::class, 'index']);
Route::post('/articles/{articleId}/comments', [MainController::class, 'storeComment']);


Route::group(['prefix'=>'/auth'], function(){
    Route::get('/registration', [AuthController::class, 'registration']);
    Route::post('/registration', [AuthController::class, 'store']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'getLogin']);
    Route::get('/logout', [AuthController::class, 'logout']);
});


Route::get('/about', function () {
    return view('main/about');
});

Route::get('/contact', function () {
    $contact = [
        'name' => 'Политех',
        'address' => 'Пряники',
        'phone' => '8(495)222-22-22',
        'email' => 'ed@mospolytech.ru',
    ];
    return view('main/contact', ['contact' => $contact]);
});
