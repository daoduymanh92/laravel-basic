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
    public function postUser(Request $request) {
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
}
