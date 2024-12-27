<?php

namespace Database\Seeders;

use App\Models\User;
use FossHaas\Identities\Models\Account;
use FossHaas\Identities\Models\AccountIdentity;
use FossHaas\Identities\Models\IdentityProvider;
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
        $idp = IdentityProvider::factory()->create([
            'slug' => 'ole-scout',
            'name' => ['en' => 'OLE Scout account'],
        ]);
        $acct = Account::factory()->create();
        $identity = AccountIdentity::factory()->forIdentityProvider($idp)->create([
            'account_id' => $acct->id,
            'identifier' => 'test',
            'profile_data' => [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'test@example.com',
            ],
        ]);
        $persona = Persona::factory()->fromAccountIdentity($identity)->create();
        $user = User::factory()->create([
            'account_id' => $acct->id,
            'persona_id' => $persona->id,
        ]);
        $acct->user_id = $user->id;
        $acct->save();
    }
}
