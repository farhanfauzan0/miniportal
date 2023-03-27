<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login/p', [AuthController::class, 'login_post'])->name('login.post');

Route::group(['middleware' => ['auth:web', 'role:admin,employee']], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('index');

    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::post('order/insert', [OrderController::class, 'insert'])->name('order.insert');
    Route::post('order/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('order/update', [OrderController::class, 'update'])->name('order.update');
    Route::post('order/delete', [OrderController::class, 'delete'])->name('order.delete');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('master/param', [MasterController::class, 'index'])->name('master.index');

        Route::post('master/p/pesanan', [MasterController::class, 'add_pesanan'])->name('master.add.pesanan');
        Route::post('master/edit/pesanan', [MasterController::class, 'edit_pesanan'])->name('master.edit.pesanan');
        Route::post('master/update/pesanan', [MasterController::class, 'update_pesanan'])->name('master.update.pesanan');
        Route::post('master/delete/pesanan', [MasterController::class, 'delete_pesanan'])->name('master.delete.pesanan');

        Route::post('master/p/status', [MasterController::class, 'add_status'])->name('master.add.status');
        Route::post('master/edit/status', [MasterController::class, 'edit_status'])->name('master.edit.status');
        Route::post('master/update/status', [MasterController::class, 'update_status'])->name('master.update.status');
        Route::post('master/delete/status', [MasterController::class, 'delete_status'])->name('master.delete.status');
    });

    Route::get('/logout', function () {
        Auth::guard('web')->logout();
        return redirect()->route('index');
    })->name('logout');
});
