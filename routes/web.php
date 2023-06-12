<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UserReservationController;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'can:isDeveloper'])->group(function () {
    // 開発者向けのルートをここに追加
    Route::get('/developer', function () {
        return 'Developer Dashboard';
    })->name('developer.dashboard');
});

Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    // 一般管理者向けのルートをここに追加
    Route::get('/admin', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'can:isUser'])->group(function () {
    // 一般ユーザー用
    // 予約可能一覧、自分の予約一覧、予約登録、予約確認、キャンセル
    Route::prefix('reservables')->group(function(){
        Route::get('', [UserReservationController::class, 'index'])->name('reservables.index');
        Route::get('/reserved_index', [UserReservationController::class, 'reservedIndex'])->name('reservables.resereved_index');
        Route::get('{reservation_id}/edit', [UserReservationController::class, 'edit'])->name('reservables.edit');
        Route::post('{reservation_id}/regist', [UserReservationController::class, 'regist'])->name('reservables.store');
        Route::get('{reservation_id}/show', [UserReservationController::class, 'show'])->name('reservables.show');
        Route::post('{reservation_id}/cancel', [UserReservationController::class, 'cancel'])->name('reservables.cancel');
    });
    
    // ユーザー情報編集、退会
});

require __DIR__.'/auth.php';
