<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'テストユーザー',
                'password' => Hash::make('password'),
                'zipcode' => '123-4567',
                'address' => '東京都渋谷区1-1-1',
                'building' => 'テストビル101',
                'is_profile_set' => true,
            ]
        );
    }
}
