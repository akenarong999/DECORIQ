<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Storemanager
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
      if(Auth::check()){
        if(Auth::user()->isStoreManager()){
          return $next($request);
        }
      }
      return redirect(404);
    }
}
