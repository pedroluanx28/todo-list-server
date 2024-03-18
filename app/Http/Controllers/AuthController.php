<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request, User $user)
    {
        $data = $request->all();

        $user->create($data);

        return response()->json([
            'message' => 'Seus dados foram cadastrados!'
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Tuas coisas estão erradas aí meu parceiro'
            ]);
        }

        $user->tokens()->delete();

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function logout()
    {
        $user = auth()->user();

        $user->tokens->delete();

        return response()->json([
            'message' => 'Você foi deslogado'
        ]);
    }

    public function me()
    {
        $user = auth()->user();

        return response()->json([
            'user' => $user
        ]);
    }
}
