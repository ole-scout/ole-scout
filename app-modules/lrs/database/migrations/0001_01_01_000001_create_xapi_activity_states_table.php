<?php

use FossHaas\Lrs\Models\XapiActivity;
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
        Schema::create('xapi_activity_states', function (Blueprint $table) {
            $table->id();
            $table->string('state_id');
            $table->foreignIdFor(XapiAgent::class, 'agent_id')
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(XapiActivity::class, 'activity_id')
                ->constrained()->cascadeOnDelete();
            $table->uuid('registration')->nullable();
            $table->string('etag');
            $table->jsonb('parsed_json')->nullable();
            $table->timestamps();

            $table->unique(['state_id', 'agent_id', 'activity_id', 'registration']);
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
