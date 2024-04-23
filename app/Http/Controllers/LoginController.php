<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function authenticate(LoginRequest $request) {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return ['token' => $request->user()
                ->createToken('auth_token')
                ->plainTextToken];
        } else {
            return response()->json([
                'errors' => ['general' => 'E-Mail oder Passwort falsch.']
            ], 422);
        }
    }

    public function checkAuth(Request $request) {
        return UserResource::make($request->user());
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out.'], 200);
    }

}
