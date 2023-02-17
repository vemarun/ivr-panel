<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;

class is_superadmin
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
              
        if(Auth::check() && Auth::user()->username=='root')
        {
            return $next($request);  //if user is reseller then proceed as normal
            
         }
        
               
        return back();
          // else throw msg
       
    }
}