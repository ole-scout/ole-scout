<?php

use FossHaas\Lrs\Enums\InverseFunctionalIdentifier;
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
        Schema::create('xapi_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('ifi_type', InverseFunctionalIdentifier::values());
            $table->string('ifi_value');
            $table->timestamps();

            $table->index(['ifi_type', 'ifi_value']);
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
