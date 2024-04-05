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


        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role', 'user'), // Default to 'user' if no role is provided
        ]);


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
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'User successfully logged out']);
    }
    public function getUser(Request $request)
    {
        $email = $request->query('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['name' => $user->name, 'role' => $user->role]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    public function makeAdmin(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
    
        if ($user) {
            $user->role = 'admin';
            $user->save();
    
            return response()->json(['message' => 'User role updated to admin']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}