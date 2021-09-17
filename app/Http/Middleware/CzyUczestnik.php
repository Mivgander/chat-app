<?php

namespace App\Http\Middleware;

use App\Models\Rozmowa;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CzyUczestnik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            $rozmowa = Rozmowa::findOrFail($request->route('id'));

            $ja = false;

            foreach($rozmowa->uczestnicy as $uczestnik)
            {
                if($uczestnik->user_id == Auth::id())
                {
                    $ja = true;
                }
            }

            if($ja == false)
            {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
