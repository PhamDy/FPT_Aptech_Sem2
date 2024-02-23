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
        Schema::create('performances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->nullable()->index('employee_id');
            $table->year('years');
            $table->integer('months');
            $table->integer('days_off')->nullable();
            $table->integer('working_days')->nullable();
            $table->double('score')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
