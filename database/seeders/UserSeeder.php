<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => '',
                'password' => Hash::make('123'),
                'isactive' => 1,
            ],
            [
                'name' => 'sales',
                'email' => 'sales@mail.com',
                'email_verified_at' => '',
                'password' => Hash::make('123'),
                'isactive' => 1,
            ],
            [
                'name' => 'customer',
                'email' => 'customer@mail.com',
                'email_verified_at' => '',
                'password' => Hash::make('123'),
                'isactive' => 1,
            ],
            [
                'name' => 'provider',
                'email' => 'provider@mail.com',
                'email_verified_at' => '',
                'password' => Hash::make('123'),
                'isactive' => 1,
            ],
        ]);
    }
}
