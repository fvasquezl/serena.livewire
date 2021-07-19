<?php

use App\Http\Livewire\Admin\Permissions\PermissionController;
use App\Http\Livewire\Admin\Roles\RoleController;
use App\Http\Livewire\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('users', UserController::class)->name('users');
Route::get('roles', RoleController::class)->name('roles');
Route::get('permissions', PermissionController::class)->name('permissions');
