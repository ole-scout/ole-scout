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
            $table->id();
            $table->foreignIdFor(CourseGroup::class, 'parent_id')->nullable()->index()
                ->constrained()->nullOnDelete();
            $table->integer('order');
            $table->string('slug')->unique();
            $table->jsonb('title');
            $table->string('color', 6);
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
