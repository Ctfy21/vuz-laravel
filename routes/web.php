<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;


Route::get('/', [MainController::class, 'index']);
Route::get('/article/{articleId}', [MainController::class, 'view']);
Route::post('/articles/{articleId}/comments', [MainController::class, 'storeComment']);

Route::get('/auth/registration', [AuthController::class, 'registration']);
Route::post('/auth/createAcc', [AuthController::class, 'createAccount']);



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
