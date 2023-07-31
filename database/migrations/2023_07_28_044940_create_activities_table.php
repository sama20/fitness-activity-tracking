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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->enum('activity_type', ['running', 'cycling', 'walking', 'swimming']);
            $table->date('activity_date');
            $table->string('name');
            $table->float('distance');
            $table->enum('distance_unit', ['kilometer', 'mile', 'meter']);
            $table->integer('elapsed_time'); // in seconds
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
