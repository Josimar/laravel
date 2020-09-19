<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class apiProtectedRoute
{

    public function handle(Request $request, Closure $next)
    {
        // cria uma regra para identificar se o usuário é um bot como por exemplo pegar o user-agent da request
        // neste caso vamos supor que caso o User Agent seja vazio o usuário é um bot
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
                return response()->json(['status'=>'Authorization Token not found']);
            }else{
                // Store the cipher method
                $ciphering = "AES-128-CTR";
                $options = 0;
                // Non-NULL Initialization Vector for decryption
                $decryption_iv = '1234567891011121';
                // Store the decryption key
                $decryption_key = "JosimarSilva";

                $token = base64_decode($token);

                // Use openssl_decrypt() function to decrypt the data
                $decryption = openssl_decrypt ($token, $ciphering, $decryption_key, $options, $decryption_iv);

                $sign = base64_decode($decryption);

                $payload = json_decode($sign);

                if ($payload->uid != "" && $payload->name != ""){
                    $request->merge(array('id' => $payload->uid));
                    return $next($request);
                }else{
                   return response()->json(['status'=>'Token is invalid']);
                }
            }
            // ToDo: expirar
            // return response()->json(['status'=>'Token is expired']);

        }catch(\Exception $e){
            return response()->json(['status'=>'Authorization error with Token']);
        }

        return $next($request);
    }
}
