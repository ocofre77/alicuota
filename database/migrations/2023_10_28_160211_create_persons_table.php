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

        Schema::create('person_types', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->timestamps();
        });

        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('document_number',13);
            $table->string('phone',10);
            $table->string('cell_phone',10);
            $table->string('address',80)->nullable();
            $table->boolean('life_here')->default(0);
            $table->date('start_date')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('person_type_id')->unsigned();
            $table->foreign('person_type_id')->references('id')->on('person_types');
            $table->timestamps();
        });        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
        Schema::dropIfExists('person_types');
    }
};
