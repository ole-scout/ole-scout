<?php

use App\Models\User;
use FossHaas\Courses\Models\Activity;
use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\CourseState;
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
        Schema::create('activity_states', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Course::class)
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Activity::class)
                ->constrained()->cascadeOnDelete();
            $table->jsonb('content_state')->default('{}');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'course_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_states');
    }
};
