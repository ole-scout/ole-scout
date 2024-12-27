<?php

use FossHaas\Identities\Enums\IdentityProviderType;
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
        Schema::create('identity_providers', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->jsonb('name');
            $table->enum('type', IdentityProviderType::values());
            $table->jsonb('config');
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
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
