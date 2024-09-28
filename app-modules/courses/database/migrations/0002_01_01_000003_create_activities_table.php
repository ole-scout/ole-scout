<?php

use FossHaas\Courses\Models\ActivityGroup;
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
        Schema::create('activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Course::class)->index()
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ActivityGroup::class)->nullable()
                ->constrained()->nullOnDelete();
            $table->string('version');
            $table->string('title');
            $table->text('description')->nullable();
            $table->morphs('content');
            $table->integer('order_column');
            $table->boolean('is_disabled')->default(false)->index();
            $table->boolean('is_required')->default(false)->index();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['course_id', 'content_id', 'content_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
