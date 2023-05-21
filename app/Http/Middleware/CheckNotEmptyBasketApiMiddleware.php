<?php

namespace App\Http\Middleware;

use App\Repositories\ContextRepository;
use Closure;
use Illuminate\Http\Request;

class CheckNotEmptyBasketApiMiddleware
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
        if ($request->has("cookie")){
            $resultBasket = ContextRepository::OrderBasketRepository()->getAllBasket($request->cookie);

            if (sizeof($resultBasket) > 0){
                $request->merge(["resultBasket" => $resultBasket]);
                return $next($request);
            }
        }

        return abort(404);
    }
}
