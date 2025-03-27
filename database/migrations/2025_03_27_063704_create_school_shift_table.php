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
        Schema::create('school_shift', function (Blueprint $table) {
            $table->id();
            $table->ulid('school_id');
            $table->ulid('shift_id');
            $table->timestamps();

            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->onDelete('CASCADE');

            $table->foreign('shift_id')
                ->references('id')
                ->on('shifts')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_shift');
    }
};
