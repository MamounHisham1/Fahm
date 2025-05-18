<?php

use App\Http\Middleware\AuthenticationCheck;
use App\Livewire\ClientInterface\Assignment;
use App\Livewire\ClientInterface\Home;
use App\Livewire\ClientInterface\Lecture;
use App\Livewire\ClientInterface\Lesson;
use App\Livewire\ClientInterface\Login;
use App\Livewire\ClientInterface\Register;
use App\Livewire\ClientInterface\Subject;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;


Route::domain('app.fahm.test')->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/pricing', 'pricing')->name('pricing');
    Route::view('/features', 'features')->name('features');
    Route::view('/about', 'about')->name('about');
    Route::view('/contact', 'contact')->name('contact');
});

Route::middleware('bindDomain')->group(function () {
    Route::get('/signin', Login::class)->name('client.login');
    Route::get('/signup', Register::class)->name('client.register');
    
    Route::middleware(AuthenticationCheck::class)->group(function () {
        Route::get('/', Home::class)->name('client.home');
        Route::get('/assignments', Assignment::class)->name('client.assignments');
        Route::get('/lectures', Lecture::class)->name('client.lectures');
        Route::get('/subjects', Subject::class)->name('client.subjects');
        Route::get('/subjects/{subject}/lessons/{lesson}', Lesson::class)->name('client.lessons.show');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
