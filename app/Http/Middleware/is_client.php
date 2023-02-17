<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;

class is_client
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
        if(Auth::check() && Auth::user()->client_type=='client')
        {
            return $next($request);  //if user is client then proceed as normal
            
         }
        
               
        return back();
            /*Response::json([
            'message' => "Fuck off"], 401);*/
        // else throw msg
       
    }
    
}
