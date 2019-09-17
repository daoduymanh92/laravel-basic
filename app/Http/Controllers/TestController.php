<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function about($name = null) {
    	return view('about')->with('name', $name);
    }

    public function tinhTong($number = 0) {
    	$tinhtong = 0;
    	if($number) { // $number > 0
    		for ($i=0; $i <= $number ; $i++) { 
    			// $tinhtong = $tinhtong + $i;
    			$tinhtong += $i;
    		}

    	}
    	return view('tinhtong')->with('tong', $tinhtong);
    }

    // tao bang html
    public function table() {
    	$users = array(
    		//data
    	);
    	return view('user_table')->with('users', $users);
    }
}
