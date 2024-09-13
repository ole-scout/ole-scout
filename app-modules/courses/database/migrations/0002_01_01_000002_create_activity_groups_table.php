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
            $table->foreignIdFor(Course::class)->index()
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ActivityGroup::class, 'parent_id')->nullable()->index()
                ->constrained('activity_groups')->nullOnDelete();
            $table->string('title');
            $table->integer('order_column');
            $table->softDeletes();
            $table->timestamps();
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
