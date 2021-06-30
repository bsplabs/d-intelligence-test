<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());

        return response([
            'status' => 'success',
            'error' => false,
            'message' => 'Success! User registered'
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:6"
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                // Laravel Password Grant Client
                // Log::info($token);
                return response()->json(
                    [
                        "status" => "success",
                        "error" => false,
                        "message" => "Success! you are logged in.",
                        "access_token" => $token,
                        // "token_type" => $token,
                    ]
                );
            }
            return response([
                "status" => "failed", 
                "message" => "Failed! invalid credentials."
            ], 404);
        }
        catch(Exception $e) {
            return response([
                "status" => "failed", 
                "message" => $e->getMessage()
            ], 404);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response([
            'status' => 'success',
            'message' => 'You have been successfully logged out!',
            'error' => false
        ], 200);
    }
}
