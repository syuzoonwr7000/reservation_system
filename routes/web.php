<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UserReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminReservationController;

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

// 開発者用
// Route::middleware(['auth', 'can:isDeveloper'])->group(function () {
//     //ユーザー管理
//     Route::prefix('users')->group(function(){
//         Route::get('', [UserController::class, 'index'])->name('users.index');
//         Route::get('{id}/show', [UserController::class, 'show'])->name('users.show');
//         Route::get('create', [UserController::class, 'create'])->name('users.create');
//         Route::post('create', [UserController::class, 'store'])->name('users.store');
//         Route::get('{id}/edit', [UserController::class, 'edit'])->name('users.edit');
//         Route::post('{id}/edit', [UserController::class, 'update'])->name('users.update');
//         Route::delete('{id}', [UserController::class, 'delete'])->name('users.delete');
//     });
        
//         //予約管理
//     Route::prefix('reservations')->group(function(){
//         Route::get('', [ReservationController::class, 'index'])->name('reservations.index');
//         Route::get('/reservable_index', [ReservationController::class, 'reservableIndex'])->name('reservations.reserevable_index');
//         Route::get('{id}/show', [ReservationController::class, 'show'])->name('reservations.show');
//         Route::get('create', [ReservationController::class, 'create'])->name('reservations.create');
//         Route::post('create', [ReservationController::class, 'store'])->name('reservations.store');
//         Route::get('{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
//         Route::post('{id}/edit', [ReservationController::class, 'update'])->name('reservations.update');
//         Route::delete('{id}', [ReservationController::class, 'delete'])->name('reservations.delete');
//     });
// });

// 一般管理者用
Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    //予約管理、予約可能日一覧、予約済み一覧、登録、編集、キャンセル
    Route::prefix('reservations')->group(function(){
        Route::get('', [AdminReservationController::class, 'index'])->name('reservations.index');
        Route::get('/reservable_index', [AdminReservationController::class, 'reservableIndex'])->name('reservations.reservable_index');
        Route::get('create', [AdminReservationController::class, 'create'])->name('reservations.create');
        Route::post('create', [AdminReservationController::class, 'store'])->name('reservations.store');
        Route::get('{id}/edit', [AdminReservationController::class, 'edit'])->name('reservations.edit');
        Route::post('{id}/edit', [AdminReservationController::class, 'update'])->name('reservations.update');
        Route::post('{reservation_id}/cancel', [AdminReservationController::class, 'cancel'])->name('reservations.cancel');
        Route::delete('{id}', [AdminReservationController::class, 'delete'])->name('reservations.delete');
    });
    
    // ユーザー情報、照会、編集
    Route::prefix('auth')->group(function(){
        Route::get('', [AuthController::class, 'show'])->name('auth.show');
        Route::get('/edit', [AuthController::class, 'edit'])->name('auth.edit');
        Route::post('/update', [AuthController::class, 'update'])->name('auth.update');
    });
});

// 一般ユーザー用
Route::middleware(['auth', 'can:isUser'])->group(function () {
    // 予約可能一覧、自分の予約一覧、予約登録、予約確認、キャンセル
    Route::prefix('reservables')->group(function(){
        Route::get('', [UserReservationController::class, 'index'])->name('reservables.index');
        Route::get('/reserved_index', [UserReservationController::class, 'reservedIndex'])->name('reservables.resereved_index');
        Route::get('{reservation_id}/edit', [UserReservationController::class, 'edit'])->name('reservables.edit');
        Route::post('{reservation_id}/regist', [UserReservationController::class, 'regist'])->name('reservables.regist');
        Route::get('{reservation_id}/show', [UserReservationController::class, 'show'])->name('reservables.show');
        Route::post('{reservation_id}/cancel', [UserReservationController::class, 'cancel'])->name('reservables.cancel');
    });
    
    // ユーザー情報、照会、編集、退会
    Route::prefix('auth')->group(function(){
        Route::get('', [AuthController::class, 'show'])->name('auth.show');
        Route::get('/edit', [AuthController::class, 'edit'])->name('auth.edit');
        Route::post('/update', [AuthController::class, 'update'])->name('auth.update');
        Route::delete('delete', [AuthController::class, 'delete'])->name('auth.delete');
    });
});

require __DIR__.'/auth.php';