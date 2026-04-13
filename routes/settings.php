<?php

use App\Http\Controllers\Settings\CompanyLogoController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', '/settings/company-logos');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('settings.profile.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])->name('settings.password.edit');

    Route::put('settings/password', [PasswordController::class, 'update'])
        ->middleware('throttle:6,1')
        ->name('settings.password.update');

    Route::get('settings/appearance', function () {
        return Inertia::render('settings/Appearance');
    })->name('settings.appearance');

    Route::get('settings/company-logos', [CompanyLogoController::class, 'index'])->name('settings.company-logos.index');
    Route::post('settings/company-logos', [CompanyLogoController::class, 'store'])->name('settings.company-logos.store');
    Route::delete('settings/company-logos/{companyLogo}', [CompanyLogoController::class, 'destroy'])->name('settings.company-logos.destroy');
});
