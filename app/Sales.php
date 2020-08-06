<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'uni_sales_data';
	
	protected $fillable = ['sales_id','date','sales_to','particular_id','quantity','rate','created_by','updated_by','deleted_at','status'];
}
