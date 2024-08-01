<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken;

class CheckTokenExpiry
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
        //Obtener el token del header
        $token = $request->bearerToken();

        //Si el token existe
        if ($token) {
            $personalAccessToken = PersonalAccessToken::findToken($token);
            if ($personalAccessToken) {
                //Obtener la fecha de creación del token y sumarle una hora
                $expiry = Carbon::parse($personalAccessToken->created_at)->addHour();
                //Si la fecha de expiración es menor a la fecha actual
                if ($expiry->lessThan(Carbon::now())) {
                    return response()->json(['message' => 'Token expired'], 401);
                }
            } else {
                return response()->json(['message' => 'Invalid token'], 401);
            }
        }

        return $next($request);
    }
}
