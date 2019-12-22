<?php

namespace App\Http\Middleware;

use App\Models\SiteOptions;
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
        $options = SiteOptions::where('option_name','isProfilacticServer')->first();
        $user = Auth::user();
        if($options['option_value']==1 && $user['post_id']!=1)
        {
            return redirect('/');
        }
        return $next($request);
    }
}
