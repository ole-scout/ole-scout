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
            $table->foreignIdFor(CourseGroup::class, 'parent_id')->nullable()->index();
            $table->string('slug')->unique()->index();
            $table->double('sort_weight')->default(1.0)->index();
            $table->softDeletes();
            $table->timestamps();
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
