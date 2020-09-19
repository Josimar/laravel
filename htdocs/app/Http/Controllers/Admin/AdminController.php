<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $rota = 'admin';

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $search = "";
        $routeName = $this->rota;
        $caminho = ['url'=>'', 'titulo'=>'Admin'];

        return view('admin.index', compact('caminho', 'search', 'routeName'));
    }

    public function token(){
        // Application Key
        $key = 'mar1976';

        $header = ['typ' => 'JWT', 'alg' => 'HS256'];

        $payload = [
            'exp' => DateTime::dateTime(),
            'uid' => 1,
            'email' => 'josimar@gmail.com'
        ];

        // JSON
        $header = json_encode($header);
        $payload = json_encode($payload);

        // Base 64
        $header = base64_encode($header);
        $payload = base64_encode($payload);

        // Sign
        $sign = hash_hmac('sha256', $header.".". $payload, $key, true);
        $sign = base64_encode($sign);

        $token = $header.'.'.$payload.'.'.$sign;

        print $token;
    }
}
