<?php

use FossHaas\Consent\CookieType;
use FossHaas\Consent\LegalBasis;
use FossHaas\Consent\Models\ServiceDefinition;
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
        Schema::create('service_cookies', function (Blueprint $table) {
            $table->id();
            $table->enum('type', CookieType::names());
            $table->string('name');
            $table->string('host');
            $table->json('description');
            $table->json('duration');
            $table->enum('legal_basis', LegalBasis::names());
            $table->timestamps();
            $table->foreignIdFor(ServiceDefinition::class)
                ->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_cookies');
    }
};
