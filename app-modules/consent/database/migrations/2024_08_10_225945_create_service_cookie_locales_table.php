<?php

use FossHaas\Consent\Models\ServiceCookie;
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
        Schema::create('service_cookie_locales', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->text('content');
            $table->text('purpose');
            $table->timestamps();
            $table->foreignIdFor(ServiceCookie::class)
                ->constrained()->cascadeOnDelete();

            $table->unique(['locale', 'service_cookie_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_cookie_locales');
    }
};
