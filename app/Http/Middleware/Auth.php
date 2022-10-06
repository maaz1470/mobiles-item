<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use Cookie;
use Session;
class Auth
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
        if(count(Admin::select('id')->get()) >= 1 && (Route('home.index') . '/' . $request->path() == Route('auth.setup'))){
            return abort(404);
        }

        if(!(Cookie::get('client') || Session::get('admin_id')) && (Route('home.index'). '/' .$request->path() != Route('auth.login'))){
            return abort(404);
        }
        
        if((Cookie::get('client') || Session::get('admin_id')) && (Route('home.index') . '/' . $request->path() == Route('auth.login'))){
            return redirect()->route('panel.dashboard');
        }


        return $next($request)->header('Cache-Control','no-cache,no-store,must-revalidate')
                              ->header('Pragma','no-cache')
                              ->header('Expire','10 Jan 1994 12:00:00 GMT');
        

        
        
    }
}
