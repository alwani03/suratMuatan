<?php

use App\Http\Controllers\Home;
use Laravolt\Platform\Enums\Permission;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\Password\Generate;
use App\Http\Controllers\User\Password\PasswordController;
use App\Http\Controllers\User\Password\Reset;
use App\Http\Controllers\SMPosController;


Route::redirect('/', 'auth/login');

Route::middleware(['auth', 'verified'])
    ->group(
        function () {
            Route::get('/home', Home::class)->name('homes');

            Route::middleware('can:'.Permission::MANAGE_USER)
            ->group(
                function () {
                    Route::resource('users', UserController::class)->except('show');
                    Route::resource('account', AccountController::class)->only('edit', 'update');
                    Route::resource('password', PasswordController::class)->only('edit');
                    Route::post('password/{id}/reset', Reset::class)->name('password.reset');
                    Route::post('password/{id}/generate', Generate::class)->name('password.generate');
                    Route::resource('pos', SMPosController::class)->only('create','store');
                    Route::post('pos/getprice', [SMPosController::class, 'getprice'])->name('pos.getprice');

                    
                }
        );
        
        }
    );

include __DIR__.'/auth.php';
include __DIR__.'/my.php';
