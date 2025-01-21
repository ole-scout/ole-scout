<?php

namespace Database\Seeders;

use App\Models\User;
use FossHaas\Identities\Models\Account;
use FossHaas\Identities\Models\Persona;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $acct = Account::factory()->create([
            'username' => 'test',
            'email' => 'test@example.com',
        ]);
        $persona = Persona::factory()->create([
            'account_id' => $acct->id,
            'first_name' => 'Test',
            'last_name' => 'User',
        ]);
        $user = User::factory()->create([
            'account_id' => $acct->id,
            'persona_id' => $persona->id,
        ]);
        $acct->user_id = $user->id;
        $acct->save();
    }
}
