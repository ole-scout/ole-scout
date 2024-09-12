<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

use function FossHaas\Support\preciseDiffForHumans;

class FakeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now();
        $count = User::factory(200)->create()->count();
        Log::info(sprintf('Created %d users', $count), [
            'time' => preciseDiffForHumans($time),
        ]);
    }
}
