<?php

use FossHaas\Courses\Models\CourseGroup;
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
        Schema::create('course_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(CourseGroup::class, 'parent_id')->nullable()->index()
                ->constrained('course_groups')->nullOnDelete();
            $table->string('slug')->index();
            $table->string('path')->index();
            $table->json('title');
            $table->text('icon')->nullable();
            $table->string('color');
            $table->integer('order_column');
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['parent_id', 'slug']);
            $table->index(['parent_id', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_groups');
    }
};
