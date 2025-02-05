<?php

use FossHaas\Lrs\Enums\XapiGroupRelationship;
use FossHaas\Lrs\Models\XapiGroup;
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
        Schema::create('xapi_related_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(XapiStatement::class, 'statement_id')
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(XapiGroup::class, 'group_id')
                ->constrained()->cascadeOnDelete();
            $table->enum('relationship', XapiGroupRelationship::values());

            $table->unique(['statement_id', 'group_id', 'relationship']);
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
