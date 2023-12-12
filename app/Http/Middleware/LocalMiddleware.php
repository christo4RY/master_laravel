<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LocalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $local = null;
        if(Auth::check() && !session()->has('local')){
            $local = $request->user()->local;
            session()->put('local',$local);
        }
        if(Auth::check()){
            $local = $request->user()->local;
            session()->put('local',$local);
        }

        if(session()->has('local')){
            $local = session()->get('local');
            session()->put('local',$local);
        }

        if(null === $local){
            $local = config('app.fallback_locale');
        }

        App::setLocale($local);
        return $next($request);
    }
}
