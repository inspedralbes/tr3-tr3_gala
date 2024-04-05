<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(base_path("users.json"));
        $data = json_decode($json);

        foreach ($data as $user) {
            DB::table('users')->insert([
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => now(),
                'password' => Hash::make($user->password),
                'role' => $user->role,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}