<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;

class is_admin
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
              
        if(Auth::check() && Auth::user()->client_type=='admin')
        {
            return $next($request);  //if user is admin then proceed as normal
            
         }
        
               
        return back();
          // else throw msg / return back
       
    }
}