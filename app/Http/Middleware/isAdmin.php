<?php

namespace App\Http\Middleware;

use App\Models\SuperAdmin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        $admin = SuperAdmin::where('email','=','admin@gmail.com')->first();
        if($admin->email == 'admin@gmail.com' ){
            return $next($request);
        }
   
        return redirect('home')->with('error',"You don't have admin access.");
    }
}
