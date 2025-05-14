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
        if(!empty($user->roles)){
            foreach ($user->roles as $role) {
                if($role->slug == ROLE_SUPERADMIN) {
                    return $next($request);
                }
            }
        }

        $currentRouteName = Route::currentRouteName();
        if ($user && !$user->hasPermission($currentRouteName)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
