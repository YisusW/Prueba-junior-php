<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('returnCode');
            $table->string('bankURL');
            $table->integer('transactionID');
            $table->string('sessionID');
            $table->float('bankFactor');
            $table->string('trazabilityCode');
            $table->integer('responseCode');
            $table->string('responseReasonText');

            $table->integer('persons_id')->unsigned();
            $table->foreign('persons_id')->references('id')->on('persons');            
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
        //
        Schema::dropIfExists('transactions');
    }
}
