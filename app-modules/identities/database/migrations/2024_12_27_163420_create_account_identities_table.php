<?php

use FossHaas\Identities\Models\Account;
use FossHaas\Identities\Models\IdentityProvider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_identities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class)
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(IdentityProvider::class)
                ->constrained()->cascadeOnDelete();
            $table->string('identifier');
            $table->jsonb('credentials')->nullable();
            $table->jsonb('profile_data')->nullable();
            $table->timestamps();

            $table->unique(['identity_provider_id', 'identifier']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
