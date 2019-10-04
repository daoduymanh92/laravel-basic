<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

class UserController extends Controller
{
    //
    public function users(Request $request) {
    	$users = User::all();
    	return view('users.index')->with('users', $users);


    }
    public function filterUser(Request $request) {
    	// dd($request->all());
    	$age = $request->age;
    	$weight = $request->weight;


    	if(isset($age) && !empty($age)) {
    		$db = User::where('age', $age);
    	}

    	if(isset($weight) && !empty($weight)) {
    		if(isset($db)) {
    			$db = $db->where('weight', $weight);
    		} else {
    			$db = User::where('weight', $weight);
    		}
    	}

    	if(isset($db)) {
    		$users = $db->get();
    	} else {
    		$users = User::all();
    	}

    	return view('users.index')
    			->with('age', $age)
    			->with('weight', $weight)
    			->with('users', $users);
    }

    // get Detail
    public function getDetail($id) {
    	$user = User::find($id); //User::where('id', $id)->first();
    	return view('users.detail')->with('user', $user);
    }
    // post user
    public function postUser(Request $request) {
	    $validatedData = $request->validate([
	    	'name' => 'required',
	    	'age' => 'required|numeric|min:5',
	    	'weight' => 'required|numeric',
	    	'email' => 'required|email'
	    ]);

	    $id = $request->id;
	    $name = $request->name;
	    $age = $request->age;
	    $weight = $request->weight;
	    $email = $request->email;
	    //update
	    if($id) {
		    User::where('id', $id)
		    		->update(
		    			array(
		    				'name' => $name,
		    				'age' => $age,
		    				'weight' => $weight,
		    				'email' => $email
		    			)
		    		);	    	
		 } else {
		 	$user = new User;
		 	$user->age = $age;
		 	$user->weight = $weight;
		 	$user->name = $name;
		 	$user->email = $email;
		 	$user->password = Hash::make('123456');
		 	$user->save();
		 }
	   	return redirect('users');
    }
    //create user
    public function newUser(){
    	return view('users.new');
    }
}
