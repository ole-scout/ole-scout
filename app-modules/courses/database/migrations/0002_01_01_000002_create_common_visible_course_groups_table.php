<?php

use FossHaas\Courses\Models\Course;
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
        Schema::create('common_visible_course_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)->index()
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CourseGroup::class)->index()
                ->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_visible_course_groups');
    }
};
