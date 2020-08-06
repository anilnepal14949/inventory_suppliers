<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'uni_customer_data';
	
	protected $fillable = ['initial_balance','customer_name','customer_type','address','contact_no','photo','created_by','updated_by','deleted_at','status'];
}
