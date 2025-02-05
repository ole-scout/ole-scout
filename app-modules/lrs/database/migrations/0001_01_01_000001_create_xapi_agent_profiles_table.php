<?php

use FossHaas\Lrs\Models\XapiAgent;
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
        Schema::create('xapi_agent_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id');
            $table->foreignIdFor(XapiAgent::class, 'agent_id')
                ->constrained()->cascadeOnDelete();
            $table->string('etag');
            $table->jsonb('parsed_json')->nullable();
            $table->timestamps();

            $table->unique(['profile_id', 'agent_id']);
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
