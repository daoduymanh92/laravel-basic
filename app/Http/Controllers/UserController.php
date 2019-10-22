<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\User;

class UserController extends Controller
{
    //
    public function users(Request $request) {
    	return view('users.index');
    }
    // get user table html
    public function userTable() {
        $users = User::all();

        $view = view('users.render.user_table')->with('users', $users)->render(); //render() to convert view object to string
        return response()->json(
            ['view' => $view]
        );
    }
    public function getUser() {
        $users = User::all();
        return response()->json(
            $users, 200
        );
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
        return response()->json(
            [
                'user' => $user,
                'msg' => 'Create a user successfully'
            ]
        );  
    }
    // post user
    public function postUser(Request $request) {
	    $validator = Validator::make($request->all() ,[
	    	'name' => 'required',
	    	'age' => 'required|numeric|min:5',
	    	'weight' => 'required|numeric',
	    	'email' => 'required|email',
            'id' => 'required|numeric'
	    ]);

        if($validator->fails()) {
            return response()->json($validator->errors() , 401);            
        }

	    $id = $request->id;
	    $name = $request->name;
	    $age = $request->age;
	    $weight = $request->weight;
	    $email = $request->email;
	    //update
        User::where('id', $id)
                ->update(
                    array(
                        'name' => $name,
                        'age' => $age,
                        'weight' => $weight,
                        'email' => $email
                    )
                );  
        return response()->json(
            [
                'msg' => 'Update a user successfully'
            ]
        ); 
    }
    // post new user
    public function createUser(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required|numeric|min:5',
            'weight' => 'required|numeric',
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors() , 401);            
        }
        $name = $request->name;
        $age = $request->age;
        $weight = $request->weight;
        $email = $request->email;

        $user = new User;
        $user->age = $age;
        $user->weight = $weight;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make('123456');
        $user->save();

        return response()->json(
            [
                'user' => $user,
                'msg' => 'Create a user successfully'
            ]
        );      
    }
    //create user
    public function newUser(){
    	return view('users.new');
    }

    //delete user
    public function deleteUser(Request $request) {
        // dd($request->id);
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors() , 401);            
        }
        $id = $request->id;

        $delete = User::where('id', $id)->delete();
        if($delete) {
            return response()->json(
                ['msg' => 'Ban xoa thanh cong'], 200
            );
        } else {
            return response()->json(
                ['msg' => 'Ban xoa that bai'], 401
            );
        }
    }
}
