<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
	    	'age' => 'required|numeric',
	    	'weight' => 'required|numeric'
	    ]);

	    $id = $request->id;
	    $name = $request->name;
	    $age = $request->age;
	    $weight = $request->weight;

	    User::where('id', $id)
	    		->update(
	    			array(
	    				'name' => $name,
	    				'age' => $age,
	    				'weight' => $weight
	    			)
	    		);

	   	return redirect('users');
    }
}
