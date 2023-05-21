<?php

namespace App\Http\Middleware;

use App\Http\Services\onTimeService\RedirectRoute\RedirectRouteService;
use App\Providers\RouteServiceProvider;
use App\Repositories\ContextRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckNotEmptyBasketMiddleware
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
        $resultBasket = ContextRepository::OrderBasketRepository()->getAllBasket(
            ContextRepository::UserRepository()->getCookieForBasket()
        );

        if (sizeof($resultBasket) > 0){
            $request->merge(["resultBasket" => $resultBasket]);
            return $next($request);
        }

        return RedirectRouteService::setMsgResultText("سبد خرید شما خالی می باشد")
            ->setRouteRedirect(route("order.basket.index"))
            ->doRedirectRouteErrorResult()
            ->doRedirect();
    }
}
