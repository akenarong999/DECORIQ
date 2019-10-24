<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StoreManagerCheckOwnStore
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
       $store_username  = $request->store_username;
        if(Auth::user()->isStoreManager() && Auth::user()->isOwnStore($store_username)  ){
          return $next($request);
        }
      }
      return redirect(404);
    }
}
