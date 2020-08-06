<?php namespace App\Auth;

use App\User;
use Carbon\Carbon; 
use Illuminate\Auth\GenericUser; 
use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Support\ServiceProvider;
use App\Auth\CustomUserProvider;
use Illuminate\Support\Facades\Hash;

class CustomUserProvider implements UserProvider{
	protected $model;
	
	public function _construct(UserContract $model){
		$this->model = $model;
	}
	
	public function retrieveById($identifier){
		$qry = User::where('id','=',$identifier);

		if($qry->count() >0)
		{
			$user = $qry->select('id', 'users_type_id', 'name', 'email', 'password')->first();

			$attributes = array(
				'id' => $user->id,
				'users_type_id' => $user->users_type_id,
				'name' => $user->name,
				'email' => $user->email,
				'password' => $user->password,
			);

			return $user;
		}
		return null;

	}
	
	public function retrieveByToken($identifier, $token)
{
		// TODO: Implement retrieveByToken() method.
		$qry = UserPoa::where('id','=',$identifier)->where('remember_token','=',$token);

		if($qry->count() >0)
		{
			$user = $qry->select('id', 'users_type_id', 'name', 'email', 'password')->first();

			$attributes = array(
				'id' => $user->id,
				'users_type_id' => $user->users_type_id,
				'name' => $user->name,
				'email' => $user->email,
				'password' => $user->password,
			);

			return $user;
		}
		return null;



	}

	/**
	 * Update the "remember me" token for the given user in storage.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
	 * @param  string $token
	 * @return void
	 */
	public function updateRememberToken(Authenticatable $user, $token)
	{
		// TODO: Implement updateRememberToken() method.
		$user->setRememberToken($token);

		$user->save();

	}
	
	public function retrieveByCredentials(array $credentials){
		// TODO: Implement retrieveByCredentials() method.
		$qry = User::where('email','=',$credentials['email']);

		if($qry->count() >0)
		{
			$user = $qry->select('id', 'users_type_id', 'name', 'email', 'password')->first();
			
			$attributes = array(
				'id' => $user->id,
				'users_type_id' => $user->users_type_id,
				'name' => $user->name,
				'email' => $user->email,
				'password' => $user->password,
			);

			
			return $user;
		}
		return null;

	}

	public function validateCredentials(Authenticatable $user, array $credentials)
	{
		// TODO: Implement validateCredentials() method.
		// we'll assume if a user was retrieved, it's good

		if($user->name == $credentials['name'] && $user->getAuthPassword() == Hash::make($credentials['password'].\Config::get('constants.SALT')))
		{

			$user->updated_at = Carbon::now();
			$user->save();

			return true;
		}
		return false;
	}

}

