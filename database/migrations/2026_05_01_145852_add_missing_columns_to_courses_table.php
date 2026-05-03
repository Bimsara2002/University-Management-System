<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'course_code')) {
                $table->string('course_code')->unique()->after('id');
            }

            if (!Schema::hasColumn('courses', 'course_name')) {
                $table->string('course_name')->after('course_code');
            }

            if (!Schema::hasColumn('courses', 'department')) {
                $table->string('department')->after('course_name');
            }

            if (!Schema::hasColumn('courses', 'instructor')) {
                $table->string('instructor')->nullable()->after('department');
            }

            if (!Schema::hasColumn('courses', 'credits')) {
                $table->integer('credits')->default(3)->after('instructor');
            }

            if (!Schema::hasColumn('courses', 'capacity')) {
                $table->integer('capacity')->default(50)->after('credits');
            }

            if (!Schema::hasColumn('courses', 'enrolled')) {
                $table->integer('enrolled')->default(0)->after('capacity');
            }

            if (!Schema::hasColumn('courses', 'schedule')) {
                $table->string('schedule')->nullable()->after('enrolled');
            }

            if (!Schema::hasColumn('courses', 'room')) {
                $table->string('room')->nullable()->after('schedule');
            }

            if (!Schema::hasColumn('courses', 'status')) {
                $table->string('status')->default('Active')->after('room');
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'course_code',
                'course_name',
                'department',
                'instructor',
                'credits',
                'capacity',
                'enrolled',
                'schedule',
                'room',
                'status',
            ]);
        });
    }
};