<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'home']);
Route::get('home', [Controller::class, 'home'])->name('dashboard');
Route::get('search', [Controller::class, 'search'])->name('search');
Route::get('about', [Controller::class, 'about'])->name('about');
Route::get('imprint', [Controller::class, 'imprint'])->name('imprint');
Route::get('privacy-policy', [Controller::class, 'privacy_policy'])->name('privacy-policy');

Route::get('login/', [AuthController::class, 'view_login'])->name('view_login');
Route::post('login/', [AuthController::class, 'login'])->name('login');
Route::post('logout/', [AuthController::class, 'logout'])->name('logout');
Route::get('signup/', [AuthController::class, 'view_signup'])->name('view_signup');
Route::post('signup/', [AuthController::class, 'signup'])->name('signup');
Route::get('signup/{id}/{token}', [AuthController::class, 'confirm_email']);
Route::get('forgot-password/', [AuthController::class, 'view_forgot_password'])->name('view_forgot_password');
Route::post('forgot-password/', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::get('email-sent/', [AuthController::class, 'view_email_sent'])->name('view_email_sent');
Route::get('reset-password/', [AuthController::class, 'view_reset_password'])->name('view_reset_password');
Route::post('reset-password/', [AuthController::class, 'reset_password'])->name('reset_password');
Route::get('confirm-email/', [AuthController::class, 'view_confirm_email'])->name('view_confirm_email');

Route::get('game/{game}', [GameController::class, 'show'])->name('game');
Route::post('game/{game}/play', [GameController::class, 'play']);

Route::get('profile/{user}', [Controller::class, 'profile'])->name('user');

Route::middleware('auth')->group(function () {
    Route::get('create', [Controller::class, 'create'])->name('create');
    Route::get('save', [GameController::class, 'create'])->name('view_save');
    Route::post('save', [GameController::class, 'upload'])->name('save');

    Route::get('profile', [Controller::class, 'profile'])->name('profile');
    Route::get('settings', [Controller::class, 'settings'])->name('settings');
    Route::get('liked', [Controller::class, 'liked'])->name('liked');
    Route::get('won', [Controller::class, 'won'])->name('won');

    Route::post('game/{game}/win', [GameController::class, 'win']);
    Route::post('game/{game}/like', [GameController::class, 'like']);
    Route::delete('game/{game}/', [GameController::class, 'destroy'])->name('delete');
});
