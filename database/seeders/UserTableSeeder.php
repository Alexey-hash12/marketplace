<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@marketplace-info',
            'password' => Hash::make('secret'),
            'role' => User::ROLE_ADMIN
        ]);

        User::create([
            'name' => 'logist',
            'email' => 'logist@marketplace-info',
            'password' => Hash::make('secret'),
            'role' => User::ROLE_LOGIST
        ]);

        User::create([
            'name' => 'storekeeper',
            'email' => 'storekeeper@marketplace-info',
            'password' => Hash::make('secret'),
            'role' => User::ROLE_STORE_KEEPER
        ]);

        User::create([
            'name' => 'packer',
            'email' => 'packer@marketplace-info',
            'password' => Hash::make('secret'),
            'role' => User::ROLE_PACKER
        ]);
    }
}
