<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\User;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginJwtController extends Controller{

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $message = new ApiMessages('Unauthorized');
            return response()->json(['error' => $message->getMessage()], 401);
        }

        // $credentials = $request->only('email', 'password');
        // Auth::attempt($credentials);

        $token = $this->createToken($user);
        $token = base64_encode($token);

        $user->api_token = hash('sha256', $token);
        $user->save();

        return response()->json([
            'token' => $token
        ]);
    }

    private function createToken($user){
        $locale = App::getLocale();

        $payload = [
            'locale' => $locale,
            'exp' => now(),
            'uid' => 1,
            'name' => 'Josimar Silva',
            'email' => 'josimar@gmail.com'
        ];

        // JSON
        $payload = json_encode($payload);

        // Base 64
        $payload = base64_encode($payload);

        // Store the cipher method
        $ciphering = "AES-128-CTR";
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';
        // Store the encryption key
        $encryption_key = "JosimarSilva";
        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($payload, $ciphering, $encryption_key, $options, $encryption_iv);

        return $encryption;
    }

}
