<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uni_particular_data',function(Blueprint $table){
            $table->increments('id');
            $table->string('particular_name');
			$table->string('description');
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
        Schema::drop('uni_particular_data');
    }
}
