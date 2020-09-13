<?php

namespace App\Http\Middleware;

use Closure;

class checkRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {


        if(auth()->user()->role ==='bibliotecario'){

            return $next($request);

        }
         return redirect('/');
    }
}
