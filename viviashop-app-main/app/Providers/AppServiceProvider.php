<?php

namespace App\Providers;

use App\Models\Order;
use App\Observers\OrderObserver;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->usePublicPath('/../../public_html');
        // $this->app->usePublicPath('/home/u875841990/domains/viviashop.com/public_html');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register Order Observer to auto-increment product sold_count
        Order::observe(OrderObserver::class);
        
        // URL::forceScheme('https');
        Paginator::useBootstrap();
        
        view()->composer('*', function ($view) {
            try {
                if (session() && session()->isStarted()) {
                    $view->with('countCart', \Gloudemans\Shoppingcart\Facades\Cart::count());
                } else {
                    $view->with('countCart', 0);
                }
            } catch (\Exception $e) {
                $view->with('countCart', 0);
            }
        });
    }
}
