<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Stripe\Stripe::setApiKey('sk_test_51OgmYFJtZ5BpZMH17e6QxCiMAGDiwJ6IJdK85tSaT2f8jbWsTh73r9jMUtBaSQ8Umx2UVDDkClrZvZZlT8ZNCFeG00F7nb6LGM');
    }
}
