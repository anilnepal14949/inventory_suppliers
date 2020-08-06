<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uni_initial_balance_data',function(Blueprint $table){
            $table->increments('id');
			$table->string('date');
            $table->integer('customer_id');
			$table->string('initial_balance');
			$table->integer('created_by');
            $table->integer('updated_by');
            $table->enum('status',['0','1']);
		
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
        Schema::drop('uni_initial_balance_data');
    }
}
