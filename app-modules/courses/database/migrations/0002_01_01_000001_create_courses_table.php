<?php

use FossHaas\Courses\Enums\Access;
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
            $table->uuid('id')->primary();
            $table->foreignIdFor(CourseGroup::class)->nullable()->index()
                ->constrained()->nullOnDelete();
            $table->integer('order_column');
            $table->string('language');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('icon')->nullable();
            $table->string('color');
            $table->string('author')->nullable();
            $table->string('clearance')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->enum('access', Access::values())->index();
            /* layout: string, is_disabled: boolean */
            $table->jsonb('cert')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['course_group_id', 'is_published']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
