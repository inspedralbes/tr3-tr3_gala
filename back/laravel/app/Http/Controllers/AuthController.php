<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
       
        $existingUser = User::where('email', $request->input('email'))->first();
    
        if ($existingUser) {

            return response()->json(['error' => 'User already exists'], 409);
        }
    
        // Si no existe un usuario, crea uno nuevo y lo guarda en la base de datos.
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
    
        // Genera un token para el usuario.
        $token = JWTAuth::fromUser($user);
    
        
        return response()->json(compact('token'));
    }


    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }
}
