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
        Schema::create('activity_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)->index();
            $table->foreignIdFor(ActivityGroup::class)->nullable()->index();
            $table->string('label');
            $table->double('sort_weight')->default(1.0)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_groups');
    }
};
