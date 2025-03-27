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
        Schema::create('grade_school', function (Blueprint $table) {
            $table->id();
            $table->ulid('grade_id');
            $table->ulid('school_id');
            $table->timestamps();

            $table->foreign('grade_id')
                ->references('id')
                ->on('grades')
                ->onDelete('CASCADE');

            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_school');
    }
};
