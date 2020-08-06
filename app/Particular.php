<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    protected $table = 'uni_particular_data';
	
	protected $fillable = ['particular_name','description','created_by','updated_by','status'];
}
