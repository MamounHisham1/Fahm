<?php

use App\Livewire\ClientInterface\Home;
use App\Livewire\ClientInterface\Login;
use App\Livewire\ClientInterface\Register;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home')->name('home');
Route::view('/pricing', 'pricing')->name('pricing');
Route::view('/features', 'features')->name('features');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::get('/clients/{client}', Home::class)->name('client.home');
Route::get('/clients/{client}/login', Login::class)->name('client.login');
Route::get('/clients/{client}/register', Register::class)->name('client.register');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
