<?php

use FossHaas\Lrs\Enums\XapiStatementRelationship;
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
        Schema::create('xapi_related_statements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(XapiStatement::class, 'statement_id')
                ->constrained()->cascadeOnDelete();
            $table->uuid('ref_id');
            $table->enum('relationship', XapiStatementRelationship::values());

            $table->unique(['statement_id', 'ref_id', 'relationship']);
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
