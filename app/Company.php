<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'uni_company_data';
	
	protected $fillable = ['company_name','address','contact_no','photo','created_by','updated_by','deleted_at','status'];
}
