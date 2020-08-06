<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dates extends Model
{
    protected $table = 'uni_dates_data';
	
	protected $fillable = ['date','purchase_id','purchase','purchased_from','purchase_quantity','purchase_rate','sales_id','sales','sales_to','sales_quantity','sales_rate','created_by','updated_by'];
}
