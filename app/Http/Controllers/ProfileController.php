<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{

   
    public function me()
    {
        $user =Auth::user();

        return response()->json([
            "message" => "Profile fetchd successfully",
            "user" => $user,
            "status" => 200
        ],200);
    }


   
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            "name" => ["string"],
            "email" => ["email","unique:users,email,".$user->id]
        ]);

        $user->update($data);

        return response()->json([
            "message" => "Profile updated successfully",
            "user" => $user,
            "status" => 200
        ],200);
    }


  
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            "current_password" => ["required"],
            "new_password" => ["required","min:8","confirmed"]
        ]);

        if(!Hash::check($data["current_password"], $user->password)){
            return response()->json([
                "message" => "Current password is incorrect"
            ],422);
        }

        $user->update([
            "password" => bcrypt($data["new_password"])
        ]);

        return response()->json([
            "message" => "Password updated successfully"
        ],200);
    }


    
    public function delete()
    {
        $user =Auth::user();

        $user->delete();

        return response()->json([
            "message" => "Account deleted successfully",
            "status" => 200
        ],200);
    }

}
