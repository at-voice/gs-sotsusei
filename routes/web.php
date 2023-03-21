<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//
// 以降追加

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::middleware(['auth', 'user_type:0'])->group(function () {
    Route::get('/test1', function () {
        return view('test1');
    });

    Route::get('/test2', function () {
        return view('test2');
    });
});

Route::middleware(['auth', 'user_type:1'])->group(function () {
    Route::get('/test3', function () {
        return view('test3');
    });

    Route::get('/test4', function () {
        return view('test4');
    });
});

// Laravel Breeze のデフォルトルート
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
}); //guest=>ログインしていない場合のルート

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});//auth=>ログインしている場合のルート
