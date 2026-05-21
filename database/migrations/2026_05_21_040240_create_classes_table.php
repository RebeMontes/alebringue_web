<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('code', 20)->unique();
            $table->string('schedule')->nullable();
            $table->uuid('teacher_id');           // sin foreign key
            $table->unsignedBigInteger('level_id')->nullable(); // sin foreign key
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('classroom_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('classroom_id');  // sin foreign key
            $table->uuid('user_id');       // sin foreign key
            $table->timestamps();
            $table->unique(['classroom_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classroom_user');
        Schema::dropIfExists('classrooms');
    }
};
