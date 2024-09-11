<?php

use FossHaas\Courses\Models\Activity;
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
        Schema::create('download_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Activity::class)->nullable()->index()
                ->constrained()->cascadeOnDelete();
            $table->text('image')->nullable();
            $table->string('filename');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_activities');
    }
};
