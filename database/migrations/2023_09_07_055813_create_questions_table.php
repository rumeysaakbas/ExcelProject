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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->String('author');
            $table->String('category');
            $table->String('text');
            $table->String('option_a');
            $table->String('option_b');
            $table->String('option_c');
            $table->String('option_d');
            $table->String('option_e');
            $table->integer('true_option')->unsigned();
            $table->float('weight');
            $table->String('explanation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
