<?php

namespace App\Http\Middleware;

use App\Models\SiteOptions;
use App\Repositories\SiteOptionsRepository;
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
            return redirect('/');
        }
        return $next($request);
    }
}
