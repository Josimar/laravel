<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class apiProtectedRoute
{

    // vendor\laravel\framework\src\Illuminate\Auth\TokenGuard.php
    // vendor\laravel\framework\src\Illuminate\Auth\Middleware\Authenticate.php

    public function handle(Request $request, Closure $next)
    {
        // cria uma regra para identificar se o usuário é um bot como por exemplo pegar o user-agent da request
        // neste caso vamos supor que caso o User Agent seja vazio o usuário é um bot
//        Log::debug('ApiProtectdRoute: handle');
        if ($request->header('user-agent') === '') {
            return redirect('https://raw.githubusercontent.com/zemirco/sf-city-lots-json/master/citylots.json');
        }

        try{
            try{
                $token = substr($_SERVER['HTTP_AUTHORIZATION'],7);
            }catch(\Exception $e){
                $token = null;
            }

            if ($token == null){
                $token = $request->token;
            }
            if ($token == null){
                $token = $request->input('api_token');
            }
            if ($token == null){
                Log::debug('ApiProtectdRoute: status=>Authorization Token not found');
                return response()->json(['status'=>'Authorization Token not found']);
            }else{
                Log::debug('ApiProtectdRoute: Token 1: ' . $token);
                // Store the cipher method
                $ciphering = "AES-128-CTR";
                $options = 0;
                // Non-NULL Initialization Vector for decryption
                $decryption_iv = '1234567891011121';
                // Store the decryption key
                $decryption_key = "JosimarSilva";

//                $token = base64_decode($token);
                $token = hash('sha256', $token);
//                Log::debug('ApiProtectdRoute: Token 2: ' . $token);

//                // Use openssl_decrypt() function to decrypt the data
//                $decryption = openssl_decrypt ($token, $ciphering, $decryption_key, $options, $decryption_iv);

//                $sign = base64_decode($decryption);

//                $payload = json_decode($sign);

//                Log::debug('User: '. auth()->user());

                $payload = auth()->user();

                if ($payload->id != "" && $payload->name != ""){
//                    Log::debug('ApiProtectdRoute: ID: OK: ' .$payload->uid);
                    $request->merge(array('id' => $payload->id));
                    return $next($request);
                }else{
//                   Log::debug('ApiProtectdRoute: Token is invalid');
                   return response()->json(['status'=>'Token is invalid']);
                }
            }
            // ToDo: expirar
            // return response()->json(['status'=>'Token is expired']);

        }catch(\Exception $e){
//            Log::debug('ApiProtectdRoute: Authorization error with Token');
            return response()->json(['status'=>'Authorization error with Token']);
        }

        return $next($request);
    }
}
