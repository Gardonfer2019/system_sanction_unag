<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Sancion
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
       
        $tipo=auth::user()->tipo;
        
        if($tipo=='1' || $tipo=='2' || $tipo=='5'){
            return $next($request);
        }elseif($tipo=='4'){
            return redirect('estudiante');
        }elseif($tipo=='3'){
            return redirect('home');
        }
       
    }
}
