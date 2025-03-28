<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(2)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
            'password' => 'admin',
        ]);
    }
}