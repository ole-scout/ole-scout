<?php

use FossHaas\Lrs\Models\XapiAgent;
use FossHaas\Lrs\Models\XapiGroup;
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
        Schema::create('xapi_group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(XapiGroup::class, 'group_id')
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(XapiAgent::class, 'agent_id')
                ->constrained()->cascadeOnDelete();

            $table->unique(['group_id', 'agent_id']);
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
