<?php

use FossHaas\Lrs\Enums\XapiAgentRelationship;
use FossHaas\Lrs\Models\XapiAgent;
use FossHaas\Lrs\Models\XapiStatement;
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
        Schema::create('xapi_related_agents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(XapiStatement::class, 'statement_id')
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(XapiAgent::class, 'agent_id')
                ->constrained()->cascadeOnDelete();
            $table->enum('relationship', XapiAgentRelationship::values());

            $table->unique(['statement_id', 'agent_id', 'relationship']);
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
