<?php

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
        Schema::create('course_lesson', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("course_id");
            $table->foreign("course_id")->on("courses")->references("id")->onDelete("CASCADE");

            $table->unsignedBigInteger("lesson_id");
            $table->foreign("lesson_id")->on("lessons")->references("id")->onDelete("CASCADE");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lesson');
    }
};
