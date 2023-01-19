<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;


Route::get('/', [MainController::class, 'index']);
Route::get('/gallery/{full}', [MainController::class, 'view']);

Route::get('/registration', [AuthController::class, 'create']);
Route::post('/signin', [AuthController::class, 'registration']);

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
