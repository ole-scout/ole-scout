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
            $table->foreignIdFor(Course::class)->index();
            $table->foreignIdFor(ActivityGroup::class)->nullable();
            $table->morphs('activity');
            $table->double('sort_weight')->default(1.0)->index();
            $table->boolean('is_disabled')->default(false)->index();
            $table->boolean('is_required')->default(false)->index();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['course_id', 'activity_id', 'activity_type']);
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
