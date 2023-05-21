<?php

namespace App\Http\Middleware;

use App\Http\Services\Login\CheckLogin;
use App\Http\Services\RedirectRoute\RedirectRouteService;
use App\Providers\RouteServiceProvider;
use App\Repositories\ContextRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoginForContinueBasketMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            return $next($request);
        }
        return RedirectRouteService::setMsgResultText("برای ثبت و نهایی کردن سفارش، باید وارد حساب کاربری خود شوید")
            ->setRouteRedirect(route("order.login.register"))
            ->doRedirectRouteErrorResult()
            ->doRedirect();
    }
}
