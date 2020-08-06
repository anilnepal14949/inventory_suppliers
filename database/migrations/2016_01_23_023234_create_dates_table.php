<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uni_dates_data',function(Blueprint $table){
            $table->increments('id');
            $table->string('date');
			$table->string('purchase_id');
			$table->integer('purchase');
			$table->integer('purchased_from');
			$table->float('purchase_quantity');
			$table->float('purchase_rate');
			$table->string('sales_id');
			$table->integer('sales');
			$table->integer('sales_to');
			$table->float('sales_rate');
			$table->float('sales_quantity');
            $table->integer('created_by');
            $table->integer('updated_by');

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
        Schema::drop('uni_dates_data');
    }
}
