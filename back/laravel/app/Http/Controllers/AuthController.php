<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

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
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    public function getInfoUser(Request $request)
    {
        $email = $request->query('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['name' => $user->name, 'role' => $user->role]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    public function makeAdmin($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->role = 'admin';
        $user->save();

        return response()->json(['message' => 'User made admin successfully'], 200);
    }
    public function makeUser($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->role = 'user';
        $user->save();

        return response()->json(['message' => 'User made admin successfully'], 200);
    }
    public function updateUser(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $name = $request->input('name');
            if ($name !== null) {
                $user->name = $name;
            }

            $newPassword = $request->input('newPassword');
            if ($newPassword !== null) {
                $user->password = bcrypt($newPassword);
            }

            $user->save();
            return response()->json(['user' => $user, 'oldEmail' => $email]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    public function updateUserList(Request $request)
    {
        $newUserList = $request->input('userList');

        if (!$newUserList) {
            return response()->json(['error' => 'User list not provided'], 400);
        }

        DB::beginTransaction();

        try {
            foreach ($newUserList as $userData) {
                try {
                    $user = User::where('email', $userData['email'])->first();

                    if (!$user) {
                        $user = new User;
                        $user->email = $userData['email'];
                    }

                    $user->name = $userData['name'];
                    // update other properties as needed

                    $user->save();
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['error' => 'Error updating user: ' . $userData['email'] . ', error: ' . $e->getMessage()], 500);
                }
            }

            DB::commit();
            return response()->json(['message' => 'User list updated successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error updating user list: ' . $e->getMessage()], 500);
        }
    }
    public function getUsers()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }
    public function deleteUser($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->compras()->delete();  // Delete associated purchases
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
    public function getRoleByEmail($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return response()->json(['role' => $user->role]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }


    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'User created successfully'], 201);
    }
}
