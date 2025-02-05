<?php

use FossHaas\Lrs\Enums\XapiActivityRelationship;
use FossHaas\Lrs\Models\XapiActivity;
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
        Schema::create('xapi_related_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(XapiStatement::class, 'statement_id')
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(XapiActivity::class, 'activity_id')
                ->constrained()->cascadeOnDelete();
            $table->enum('relationship', XapiActivityRelationship::values());

            $table->unique(['statement_id', 'activity_id', 'relationship']);
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
