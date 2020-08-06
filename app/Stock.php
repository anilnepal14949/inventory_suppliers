<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'uni_stock_data';
	
	protected $fillable = ['particular_id','description','created_by','updated_by','status'];
}
