<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserControl
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Verificamos si el usuario tiene permisos de admin, genrente o usuario regular
         */
        try {
            $user = Auth::guard('api')->user();
            if ($user->level === 'admin') {
                return $next($request);
            } else {
                return json_response(trans('auth.not.allow'),403);
            }
        } catch (\Exception $e) {
            return json_response(trans('auth.not.allow'),403);
        }
    }
}
