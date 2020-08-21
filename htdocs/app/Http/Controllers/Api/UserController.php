<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        // return response()->json(['message'=>__METHOD__]);
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        return response()->json(['message'=>__METHOD__]);
    }

    public function show($id)
    {
        return response()->json(['message'=>__METHOD__]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message'=>__METHOD__]);
    }

    public function destroy($id)
    {
        return response()->json(['message'=>__METHOD__]);
    }
}
