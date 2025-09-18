<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 平台管理者
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // 判斷條件
            [
                'name'     => 'Admin',
                'password' => Hash::make('000'),
                'role'     => 'admin',
            ]
        );

        // 一般使用者
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name'     => '一般使用者',
                'password' => Hash::make('000'),
                'role'     => 'user',
            ]
        );

        // 場地管理者
        User::firstOrCreate(
            ['email' => 'venue@example.com'],
            [
                'name'     => '場地管理者',
                'password' => Hash::make('000'),
                'role'     => 'venue_manager',
            ]
        );
    }
}
