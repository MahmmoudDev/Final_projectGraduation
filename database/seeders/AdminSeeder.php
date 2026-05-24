<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([

            'name' =>
            'Super Admin',

            'email' =>
            'admin@test.com',

            'mobile' =>
            '0599999999',

            'password' =>
            Hash::make(
                '12345678'
            ),

            'status' =>
            1,
        ]);
    }
}
