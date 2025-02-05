<?php

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
        Schema::create('xapi_statements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->jsonb('parsed_json');
            $table->string('registration')->nullable();
            $table->string('verb_id');
            $table->timestamp('timestamp');
            $table->foreignIdFor(XapiStatement::class, 'voided_by')->nullable()
                ->constrained()->nullOnDelete();
            $table->timestamps();
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
