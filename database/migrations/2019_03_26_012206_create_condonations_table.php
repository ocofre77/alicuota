<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('condonations', function (Blueprint $table) {
             $table->id();
             $table->bigInteger('user_id')->unsigned();
             $table->bigInteger('transaction_id')->unsigned();
             $table->string('note',60);
             $table->decimal('value',8,2);
             $table->timestamps();
         });
     }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condonations');
    }
}
