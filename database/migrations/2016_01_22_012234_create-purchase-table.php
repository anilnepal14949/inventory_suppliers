<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uni_purchase_data',function(Blueprint $table){
            $table->increments('id');
			$table->string('purchase_id');
            $table->string('date');
			$table->integer('purchased_from');
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
        Schema::drop('uni_purchase_data');
    }
}
