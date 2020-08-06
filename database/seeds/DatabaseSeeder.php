<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserSeeder::class);
		$this->call(NewUserSeeder::class);

        Model::reguard();
    }
}

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        User::create(array(
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),//Hash::make('admin123'),
        ));
    }

}

class NewUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('user123'),//Hash::make('user123'),
        ));
    }

}