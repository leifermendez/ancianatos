<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRangeLevel
{
    private function checkLevel($id = null)
    {
        return User::find($id);
    }

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
            if ($user->level === 'manager' || $user->level === 'admin') {
                if ($user->level === 'admin') {
                    return $next($request);
                } else {
                    if ($this->checkLevel($user->user_id)->level === 'admin') {
                        return $next($request);

                    } else {
                        return json_response(trans('auth.not.allow'), 200);
                    }
                }

            } else {
                return json_response(trans('auth.not.allow'), 403);
            }
        } catch (\Exception $e) {
            return json_response(trans('auth.not.allow'), 403);
        }
    }
}
