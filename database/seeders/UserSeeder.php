<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'password' => 'dhela123',
                'email' => 'dhela@students.com',
                'role' => '1'
            ],
            [
                'password' => 'tera123',
                'email' => 'tera@students.com',
                'role' => '1'
            ],
            [
                'password' => 'aurel123',
                'email' => 'aurel@students.com',
                'role' => '1'
            ],
            [
                'password' => 'nabila123',
                'email' => 'nabila@students.com',
                'role' => '1'
            ],
            [
                'password' => 'kamaruddin123',
                'email' => 'kamaruddin@dosen.com',
                'role' => '7' 
            ],
            [
                'password' => 'azizah123',
                'email' => 'azizah@students.com',
                'role' => '2'
            ],
            [
                'password' => 'dinal123',
                'email' => 'dinal@bak.com',
                'role' => '3'
            ],
            [
                'password' => 'priyol123',
                'email' => 'priyo@bak.com',
                'role' => '6'
            ]
        ];

        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            User::create($user);
        }
    }
}