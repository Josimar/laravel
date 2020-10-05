<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Api\ApiMessages;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class LoginJwtController extends Controller{

    public function login(Request $request){

        Log::debug('Api - LoginJwtController - login: '. implode( ',', $request->all()));

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
            'id' => $user->id,
            'email' => $user->email,
            'nome' => $user->name,
            'urlfoto' => $user->urlfoto,
            'admin' => '1',
            'token' => $token
        ]);
    }

    public function cadastro(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        $email = $request->email;
        $name = $request->name;
        $password = $request->password;

        if ($request->name == null || $request->name == ""){
            $name = $email;
        }
        if ($request->password == null || $request->password == ""){
            $password = '123456';
        }

        if ($user == null){
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
        }

        $token = $this->createToken($user);
        $token = base64_encode($token);

        $user->api_token = hash('sha256', $token);
        $user->uid = $request->uid;
        if ($request->foto != null && $request->foto != ""){
            $user->urlfoto = $request->foto;
        }
        $user->save();

        $user->profile()->create(
            [
                'fone' => $request->fone,
                'foto' => $request->foto,
                'uid' => $request->uid,
                'app' => $request->app
            ]
        );

        return response()->json([
            'id' => $user->id,
            'email' => $user->email,
            'nome' => $user->name,
            'urlfoto' => $request->foto,
            'admin' => '1',
            'token' => $token
        ]);
    }

    private function createToken($user){
        $locale = App::getLocale();

        $payload = [
            'locale' => $locale,
            'exp' => now(),
            'uid' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];

        // JSON
        $payload = json_encode($payload);

        $encryption = Hash::make($payload);

//        // Base 64
//        $payload = base64_encode($payload);

//        // Store the cipher method
//        $ciphering = "AES-128-CTR";
//        // Use OpenSSl Encryption method
//        $iv_length = openssl_cipher_iv_length($ciphering);
//        $options = 0;
//        // Non-NULL Initialization Vector for encryption
//        $encryption_iv = '1234567891011121';
//        // Store the encryption key
//        $encryption_key = "JosimarSilva";
//        // Use openssl_encrypt() function to encrypt the data
//        $encryption = openssl_encrypt($payload, $ciphering, $encryption_key, $options, $encryption_iv);

        return $encryption;
    }

}
