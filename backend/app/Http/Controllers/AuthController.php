<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function reg(StoreUserRequest $request)
    {
        try {
            $validData = $request->validated();

            User::create(['email' => $validData['email'], 'password' => $validData['password']]);

            return response()->json(['message' => 'success'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
    public function login(Request $request)
    {
        try {
            $validData = $request->validate(['email' => 'required', 'email', 'password' => ['required', Password::min(3)
                ->mixedCase()
                ->numbers()]]);

            $user = User::where('email', $validData['email'])->firstOrFail();
            if (Hash::check($validData['password'], $user->password)) {
                return response()->json(['message' => 'success', 'token' => $user->createToken('api')->plainTextToken]);
            } else {
                return response()->json(['message' => 'invalid credentials'], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 400);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout'], 201);
    }
    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }
}
