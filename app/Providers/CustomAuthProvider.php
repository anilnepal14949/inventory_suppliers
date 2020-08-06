<?php namespace App\Providers;

use App\User;
use App\Auth\CustomUserProvider;
use Illuminate\Support\ServiceProvider;

class CustomAuthProvider extends ServiceProvider{
	
	public function boot(){
		$this->app['auth']->extend('custom',function(){
			return new CustomUserProvider(new User);
		});
	}
	
	public function register(){
		
	}	
	
}

