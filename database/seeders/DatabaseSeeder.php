<?php

namespace Database\Seeders;

use App\Models\User;
use FossHaas\Consent\Database\Seeders\FakeServicesSeeder;
use FossHaas\Courses\Database\Seeders\FakeCoursesSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('test'),
            'is_admin' => true,
        ]);

        $this->call([
            SystemServicesSeeder::class,
            FakeUsersSeeder::class,
            FakeServicesSeeder::class,
            FakeCoursesSeeder::class,
        ]);
    }
}
