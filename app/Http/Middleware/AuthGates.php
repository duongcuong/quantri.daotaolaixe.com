<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthGates
{
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::guard('admin')->user();
        $currentRouteName = Route::currentRouteName();

        // if ($user && !$user->hasPermission($currentRouteName)) {
        //     abort(403, 'Unauthorized action.');
        // }

        return $next($request);
    }
}
