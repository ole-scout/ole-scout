<?php

use FossHaas\Courses\Enums\Access;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CourseGroup::class, 'group_id')->nullable()
                ->constrained()->nullOnDelete();
            $table->integer('order');
            $table->string('language');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color', 6);
            $table->enum('access', Access::values())->index();
            $table->boolean('cert_is_hidden')->default(false);
            $table->string('cert_layout')->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('course_prereqs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Course::class, 'prereq_id')
                ->constrained()->cascadeOnDelete();
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
