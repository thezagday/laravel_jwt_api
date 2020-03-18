<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RolesAuthorization extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = $this->auth->setRequest($request)->getToken();
            $user  = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            return $this->unauthorized('Your token has expired. Please, login again.');
        } catch (TokenInvalidException $e) {
            return $this->unauthorized('Your token is invalid. Please, login again.');
        } catch (JWTException $e) {
            return $this->unauthorized('Please, attach a Bearer Token to your request');
        }

        if ($user && ($user->hasRole(Role::SYSADMIN) || $user->hasRole(Role::ADMIN))) {
            return $next($request);
        }

        return $this->unauthorized();
    }

    private function unauthorized($message = null)
    {
        return response()->json(
            [
                'message' => $message ? $message : 'You are unauthorized to access this resource',
                'success' => false,
            ],
            401
        );
    }
}
