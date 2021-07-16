<?php

use App\Http\Livewire\Admin\Permissions\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('permissions', PermissionController::class)->name('permissions');
