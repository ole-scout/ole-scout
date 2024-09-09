<?php

use App\Models\User;
use FossHaas\Courses\Models\CourseGroup;
use FossHaas\Courses\Models\Enrollment;
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
        Schema::create('visible_course_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->index()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CourseGroup::class)->index()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Enrollment::class)->index()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visible_course_groups');
    }
};
