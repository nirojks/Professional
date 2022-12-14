<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        if (auth()->user()->type == 'professional') {
            return $next($request);
        }
        $notification=array(
            'messege'=> "You dont have permission to access this module",
            'alert-type'=>'error'
        );
        return redirect()->route('user.dashboard')->with($notification);

    }
}
