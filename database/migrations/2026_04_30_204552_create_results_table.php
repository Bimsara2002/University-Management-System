<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('semester'); // e.g. "2024/25 Sem 1"
            $table->decimal('marks_obtained', 5, 2)->default(0);
            $table->decimal('total_marks', 5, 2)->default(100);
            $table->string('grade')->nullable(); // A+, A, B+, B, C, D, F
            $table->decimal('gpa', 3, 2)->nullable(); // 0.00 - 4.00
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'course_id', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
