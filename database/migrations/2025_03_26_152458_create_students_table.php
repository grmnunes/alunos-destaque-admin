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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 150);
            $table->string('registration_number', 12);
            $table->ulid('school_id');
            $table->string('session', 20)->index();
            $table->string('grade', 20)->index();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['registration_number', 'school_id']);

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
        Schema::dropIfExists('students');
    }
};
