<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) return response()->json($validator->errors());

        $user = User::where('email', $request->only('email'))->first();;
        if (!$user) return response()->json("User not found");
        return $user->createToken('token-name', ['server:update'])->plainTextToken;
    }
}
