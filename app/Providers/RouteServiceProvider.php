<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    const HOME = '/';

    const CUSTOMER_HOME = "customer.home";

    const ADMIN_LOGIN = 'admin-auth.form-login';
    const ADMIN_PANEL = 'admin.home';


    protected $namespaceAdmin = 'App\\Http\\Controllers\\Admin';
    protected $namespaceAPI = 'App\\Http\\Controllers\\API';
    protected $namespaceAuth = 'App\\Http\\Controllers\\Auth';
    protected $namespaceCustomer = 'App\\Http\\Controllers\\Customer';
    protected $namespaceBasket = 'App\\Http\\Controllers\\Basket';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();


        $this->routes(function () {

            Route::middleware('api')
                ->namespace($this->namespaceAPI)
                ->prefix('api')
                ->group(base_path('routes/api.php'));


            Route::middleware("web")->group(function (){


                /// auth client pages
                Route::prefix("admin-auth")
                    ->namespace($this->namespaceAuth."\Admin")
                    ->group(base_path('routes/authAdmin.php'));


                /// admin pages
                Route::namespace($this->namespaceAdmin)
                    ->middleware(["auth.admin"])
                    ->prefix('admin-panel')
                    ->group(base_path('routes/admin.php'));

                /// pages
                Route::namespace($this->namespaceCustomer)
                    ->group(base_path('routes/web.php'));


            });

        });
    }



    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });



        RateLimiter::for('check-last-login-client', function (Request $request) {
            return Limit::perMinute(500)->by(url()->current().$request->ip());
        });

        RateLimiter::for('customer-login-register-limiter', function (Request $request) {
            return Limit::perMinute(500)->by($request->ip());
        });

        RateLimiter::for('customer-login-confirm-limiter', function (Request $request) {
            return Limit::perMinute(500)->by(url()->current().$request->ip());
        });

        RateLimiter::for('customer-login-resend-limiter', function (Request $request) {
            return Limit::perMinute(500)->by( url()->current().$request->ip());
        });



        RateLimiter::for('admin-login-try-limiter', function (Request $request) {
            return Limit::perMinute(5)->by( url()->current().$request->ip());
        });
    }
}
