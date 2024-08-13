<?php

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
        Schema::create('service_definition_locales', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
            $table->foreignIdFor(ServiceDefinition::class)
                ->constrained()->cascadeOnDelete();

            $table->unique(['locale', 'service_definition_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_definition_locales');
    }
};
