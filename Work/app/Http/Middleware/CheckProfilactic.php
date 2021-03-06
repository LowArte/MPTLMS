<?php

namespace App\Http\Middleware;

use App\Repositories\ModelRepository\SiteOptionsRepository;
use Closure;

use Illuminate\Support\Facades\Auth;

class CheckProfilactic
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
        $siteOptionsRepository = app(SiteOptionsRepository::class);
        $options = $siteOptionsRepository->getIsProfilactic();
        $user = auth()->user();
        if($options && $user['post_id']!=1)
        {
            return response()->json(["success"=>false]);
        }
        return $next($request);
    }
}
