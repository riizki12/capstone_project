<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
    * Handle an incoming request.
    *
    * @param  Request  $request
    * @param  Closure  $next
    * @return Response
    */
    public function handle(Request $request, Closure $next, $role = null)
    {
    if ($role && Auth::check() && Auth::user()->role === $role) {
        return $next($request);
    }

    abort(403, 'Unauthorized');
    }

}
   