<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Console\Commands\DailyUpdateLoan as Duls;
class CheckAge
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
        $ob = new Duls();
        $ob->handle();

        return $next($request);
    }
}
