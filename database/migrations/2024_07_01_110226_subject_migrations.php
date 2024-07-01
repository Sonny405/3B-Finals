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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained(
                table: 'students', indexName: 'id'
            )->onDelete('cascade');
            $table->string('subject_code');
            $table->string('name');
            $table->string('description');
            $table->string('instructor');
            $table->string('schedule');
            $table->json('grades');
            $table->double('average_grade');
            $table->string('remarks');
            $table->string('date_taken');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
