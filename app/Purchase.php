<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'uni_purchase_data';
	
	protected $fillable = ['purchase_id','date','purchased_from','particular_id','quantity','rate','created_by','updated_by','deleted_at','status'];
}
