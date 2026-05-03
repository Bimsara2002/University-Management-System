<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->string('department');
            $table->string('instructor')->nullable();
            $table->integer('credits')->default(3);
            $table->integer('capacity')->default(50);
            $table->integer('enrolled')->default(0);
            $table->string('schedule')->nullable();
            $table->string('room')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};