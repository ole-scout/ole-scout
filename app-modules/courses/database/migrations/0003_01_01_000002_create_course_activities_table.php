<?php

use FossHaas\Courses\Models\Course;
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
        Schema::create('course_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->integer('order');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('type');
            $table->jsonb('content');
            $table->boolean('is_required')->default(false);
            $table->boolean('is_disabled')->default(false);
            $table->boolean('is_hidden')->default(false);
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
