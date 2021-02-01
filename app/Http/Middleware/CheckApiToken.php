<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) // handle e' la funzione che invoca la rotta
    {
        $auth_token = $request->header('authorization');
         // token
        if(empty($auth_token)){ // se manca il token allora
            return response()->json([
                'success' => false,
                'error' => 'Api Token mancante'
            ]);
        }

        $api_token = substr($auth_token, 7); // prendo solo il token senza il bearer
        $user = User::where('api_token', $api_token)->first(); //controllo nel db se $api_token e' presente nella colonna api_token nella tabella users e ne verifico la correttezza
        if(!$user){ // se il token non corrisponde allora
            return response()->json([
                'success' => false,
                'error' => 'Api Token errata'
            ]);
        }
        return $next($request);
    }
}
