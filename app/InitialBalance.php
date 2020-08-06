<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InitialBalance extends Model
{
    protected $table = 'uni_initial_balance_data';
	
	protected $fillable = ['date','initial_balance','customer_name','customer_type','created_by','updated_by','status'];
}
