<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Admin',
            'email' => 'common@user.com',
        ]);
        $user = User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@user.com',
        ]);
        $user->assignRole('admin');
        UserRequest::factory(100_000)->create();
    }
}
