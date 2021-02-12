<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SoloCdf
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
        switch(auth::user()->tipo)
        {
            case('1'):
                return redirect('csu');
            break;
            case('2'):
                return $next($request);
            break;
            case('3'):
                return redirect('home');
            break;
            case('4'):
                return redirect('estudiante');
            break; 
            case('5'):
                return redirect('dde');
            break;   
        }
    }
}
