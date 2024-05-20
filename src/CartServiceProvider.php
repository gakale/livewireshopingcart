<?php

namespace LivewireShopping\LivewireShoppingCart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cart', function ($app) {
            return new CartManager(); // Class to manage cart operations
        });
    }

    public function boot()
    {
        // Publish the configuration file
        $this->publishes([
            __DIR__ . '/../config/cart.php' => config_path('cart.php'),
        ], 'config');
    }
}
