<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( ! \Facades\App\Cache\UsersCache::getActiveCompany() ){
            session()->flash('message', 'Please select company to proceed!.');
            return redirect('/company');
        }
        return $next($request);
    }
}
