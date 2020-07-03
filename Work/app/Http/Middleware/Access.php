<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path =  $request->getRequestUri();
        if(!strpos($path,auth()->user()->post->slug))
        {
            return redirect(RouteServiceProvider::GetHOME());
        }
        return $next($request);
    }
}
