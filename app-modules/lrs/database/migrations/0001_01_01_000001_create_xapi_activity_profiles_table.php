<?php

use FossHaas\Lrs\Models\XapiActivity;
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
        Schema::create('xapi_activity_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id');
            $table->foreignIdFor(XapiActivity::class, 'activity_id')
                ->constrained()->cascadeOnDelete();
            $table->string('etag');
            $table->jsonb('parsed_json')->nullable();
            $table->timestamps();

            $table->unique(['profile_id', 'activity_id']);
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
