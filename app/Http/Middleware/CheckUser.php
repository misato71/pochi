<?php

namespace App\Http\Middleware;

use Closure;
use Facades\App\Item;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        $user = Item::where('id', $request->id)->first();
        if($user->user_id == Auth::user()->id){
            return $next($request);

        }

        return redirect()->back();
    }
}
