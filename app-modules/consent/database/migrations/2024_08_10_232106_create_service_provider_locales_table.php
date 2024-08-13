<?php

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
        Schema::create('service_provider_locales', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('privacy_policy')->nullable();
            $table->string('imprint')->nullable();
            $table->string('contact')->nullable();
            $table->timestamps();
            $table->foreignId('service_provider_id')
                ->constrained()->cascadeOnDelete();

            $table->unique(['locale', 'service_provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_provider_locales');
    }
};
