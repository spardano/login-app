<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class izinSuratUmum
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
        //ambil id user yang sedang login
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id)->first();

        if ($user->hasRole(['adminkelurahan', 'admin', 'pejabat'])) {
            return $next($request);
        } else {
            return redirect('others/unauthorized');
        }
    }
}