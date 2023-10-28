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
        Schema::create('aliquot_values', function (Blueprint $table) {
            $table->id();
            $table->decimal('value',8,2);
            $table->date('start_date');
            $table->date('end_date');
            $table->bigInteger('property_type_id')->unsigned();
            $table->foreign('property_type_id')->references('id')->on('property_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aliquot_values');
    }
};
