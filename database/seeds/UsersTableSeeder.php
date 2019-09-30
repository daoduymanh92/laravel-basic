<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 5; $i++) { 
        	# code...
        	$user = new User;
        	$user->name = Str::random(10);
        	$user->email = Str::random(10).'@gmail.com';
        	$user->password = bcrypt('password');
        	$user->age = rand(18, 40);
        	$user->weight = rand(40, 50);
        	$user->save();
        }
    }
}
