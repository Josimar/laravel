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
use Illuminate\Support\Facades\Password;

class LoginJwtController extends Controller{

    public function login(Request $request){
        // return response()->json(['message'=>__METHOD__]);

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

    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }

    public function reset() {
        // return response()->json(['message'=>__METHOD__]);

        $credentials = request()->validate([
            'email' => 'required|email',
            'api_token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "Password has been successfully changed"]);
    }

    public function resetPassword() {
        // return response()->json(['message'=>__METHOD__]);

        $data = request()->all();
        // dd($data);

        // valor default de email
        if (!isset($data['email']) || $data['email'] == ""){
            return response()->json(["msg" => "Invalid email"], 400);
        }else{
            $email = $data['email'];
            if ($email == null || $email == ''){
                return response()->json(["msg" => "Invalid email"], 400);
            }
        }

        // valor default de password
        if (!isset($data['password']) || $data['password'] == ""){
            return response()->json(["msg" => "Invalid password"], 400);
        }else{
            $password = $data['password'];
            if ($password == null || $password == ''){
                return response()->json(["msg" => "Invalid password"], 400);
            }
        }

        $user = User::where('email', $email)->first();
        //dd($user);

        $user->password = Hash::make($password);
        $user->save();

        return response()->json(["msg" => "Password has been successfully changed"]);
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
