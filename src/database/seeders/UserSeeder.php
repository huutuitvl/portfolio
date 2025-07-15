<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\User\Domain\Entities\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin CMS',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}

