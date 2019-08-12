<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next,...$role)
    {
        if (in_array(Auth::user()->role,$role)) {
          return $next($request);
        }

        if ($request->ajax()) {
          return response('Unauthorized',501);
        }
        session()->flash('msg','Unauthorized');
        session()->flash('type','error');
        return redirect('/');
    }

}
