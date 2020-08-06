<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uni_sales_data',function(Blueprint $table){
            $table->increments('id');
			$table->string('sales_id');
            $table->string('date');
			$table->integer('sales_to');
			$table->integer('particular_id');
			$table->float('quantity');
			$table->float('rate');
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
        Schema::drop('uni_sales_data');
    }
}
