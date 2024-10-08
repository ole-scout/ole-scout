<?php

use FossHaas\Consent\Enums\Category;
use FossHaas\Consent\Models\ServiceProvider;
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
        Schema::create('service_definitions', function (Blueprint $table) {
            $table->id();
            $table->enum('category', Category::values());
            $table->json('name');
            $table->json('description');
            $table->timestamps();
            $table->foreignIdFor(ServiceProvider::class)->nullable()
                ->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_definitions');
    }
};
