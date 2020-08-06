<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uni_company_data',function(Blueprint $table){
            $table->increments('id');
            $table->string('company_name');
			$table->string('address');
			$table->string('contact_no');
			$table->string('photo');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->enum('status',['0','1']);
			
			$table->timestamp('deleted_at')->nullable();
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
        Schema::drop('uni_company_data');
    }
}
