<?php

namespace App\Http\Middleware;

use App\BannedIp;
use Closure;

class IsIpBanned
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
        $isBanned = BannedIp::where('ip', $request->ip())->exists();

        if($isBanned){
            auth()->logout();
            return redirect('ipbanned');
        }

        return $next($request);
    }
}
