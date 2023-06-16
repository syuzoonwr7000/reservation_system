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

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->can('isDeveloper')) {
            return redirect()->route('users.index');
        } elseif (auth()->user()->can('isAdmin')) {
            return redirect()->route('admin.reservations.reserved_index');
        } elseif (auth()->user()->can('isUser')) {
            return redirect()->route('user.reservations.reservable_index');
        }
    }
})->middleware(['auth']);

// 開発者用
Route::middleware(['auth', 'can:isDeveloper'])->group(function () {
    //ユーザー管理
    Route::prefix('users')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('users.index');
        Route::get('{id}/show', [UserController::class, 'show'])->name('users.show');
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::post('create', [UserController::class, 'store'])->name('users.store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('{id}/edit', [UserController::class, 'update'])->name('users.update');
        Route::delete('{id}', [UserController::class, 'delete'])->name('users.delete');
    });
        
        //予約管理
    Route::prefix('reservations')->group(function(){
        Route::get('', [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('/reservable_index', [ReservationController::class, 'reservableIndex'])->name('reservations.reserevable_index');
        Route::get('{id}/show', [ReservationController::class, 'show'])->name('reservations.show');
        Route::get('create', [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('create', [ReservationController::class, 'store'])->name('reservations.store');
        Route::get('{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
        Route::post('{id}/edit', [ReservationController::class, 'update'])->name('reservations.update');
        Route::delete('{id}', [ReservationController::class, 'delete'])->name('reservations.delete');
    });
});

// 一般管理者用
Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    //予約管理、予約可能日一覧、予約済み一覧、登録、編集、キャンセル
    Route::prefix('admin/reservations')->group(function(){
        Route::get('/reserved_index', [AdminReservationController::class, 'reservedIndex'])->name('admin.reservations.reserved_index');
        Route::get('/reservable_index', [AdminReservationController::class, 'reservableIndex'])->name('admin.reservations.reservable_index');
        Route::get('/create', [AdminReservationController::class, 'create'])->name('admin.reservations.create');
        Route::post('/create', [AdminReservationController::class, 'store'])->name('admin.reservations.store');
        Route::get('{id}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');
        Route::post('{id}/edit', [AdminReservationController::class, 'update'])->name('admin.reservations.update');
        Route::post('{reservation_id}/cancel', [AdminReservationController::class, 'cancel'])->name('admin.reservations.cancel');
        Route::delete('{id}', [AdminReservationController::class, 'delete'])->name('admin.reservations.delete');
    });
    
    // ユーザー情報、照会、編集
    Route::prefix('admin')->group(function(){
        Route::get('', [AuthController::class, 'show'])->name('admin.show');
        Route::get('/edit', [AuthController::class, 'edit'])->name('admin.edit');
        Route::post('/update', [AuthController::class, 'update'])->name('admin.update');
    });
});

// 一般ユーザー用
Route::middleware(['auth', 'can:isUser'])->group(function () {
    // 予約可能一覧、自分の予約一覧、予約登録、予約確認、キャンセル
    Route::prefix('user/reservations')->group(function(){
        Route::get('/reservable_index', [UserReservationController::class, 'reservableIndex'])->name('user.reservations.reservable_index');
        Route::get('/reserved_index', [UserReservationController::class, 'reservedIndex'])->name('user.reservations.resereved_index');
        Route::get('{reservation_id}/edit', [UserReservationController::class, 'edit'])->name('user.reservations.edit');
        Route::post('{reservation_id}/regist', [UserReservationController::class, 'regist'])->name('user.reservations.regist');
        Route::get('{reservation_id}/show', [UserReservationController::class, 'show'])->name('user.reservations.show');
        Route::post('{reservation_id}/cancel', [UserReservationController::class, 'cancel'])->name('user.reservations.cancel');
    });
    
    // ユーザー情報、照会、編集、退会
    Route::prefix('user')->group(function(){
        Route::get('', [AuthController::class, 'show'])->name('user.show');
        Route::get('/edit', [AuthController::class, 'edit'])->name('user.edit');
        Route::post('/update', [AuthController::class, 'update'])->name('user.update');
        Route::delete('delete', [AuthController::class, 'delete'])->name('user.delete');
    });
});

require __DIR__.'/auth.php';