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
        Schema::table('students', function (Blueprint $table) {

            $table->ulid('shift_id');
            $table->ulid('grade_id');

            $table->foreign('shift_id')
                ->references('id')
                ->on('shifts')
                ->onDelete('CASCADE');

            $table->foreign('grade_id')
                ->references('id')
                ->on('grades')
                ->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('session')->nullable();
            $table->string('grade')->nullable();
        });
    }
};
