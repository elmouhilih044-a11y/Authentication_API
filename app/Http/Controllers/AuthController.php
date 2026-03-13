<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
{
    $data = $request->validate([
        "name" => ["required","string"],
        "email" => ["required","email","unique:users"],
        "password" => ["required","min:8"]
    ]);

    $data["password"] = bcrypt($data["password"]);

    $user = User::create($data);

    if ($user) {
        return response()->json([
            "message" => "Account created successfully",
            "user" => $user,
            "status" => 201
        ],201);
    } else {
        return response()->json([
            "message" => "error",
            "status" => 404
        ],404);
    }
}


public function login(Request $request)
{
    $data = $request->validate([
        "email" => ["required","email"],
        "password" => ["required"]
    ]);

    if(!$token = Auth::attempt($data)){
        return response()->json([
            "message" => "Invalid credentials",
            "status" => 401
        ],401);
    }

    return response()->json([
        "message" => "Login successful",
        "token" => $token,
        "status" => 200
    ],200);
}

public function logout()
{
    Auth::logout();

    return response()->json([
        "message" => "Logout successful",
        "status" => 200
    ],200);
}

public function refresh()
{
    $token = Auth::refresh();

    return response()->json([
        "message" => "Token refreshed successfully",
        "token" => $token,
        "status" => 200
    ],200);
}



}
