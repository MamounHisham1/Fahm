<?php

namespace App\Providers;

use Filament\Forms\Components\Select;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Select::configureUsing(fn (Select $select) => $select->native(false));
    }
}
