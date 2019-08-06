<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomeController extends Controller{

	protected $path = 'client.';

	public function home(){
		$user = current_user();

		$username = $user->name;
		$useremail = $user->email;
		$subscription = $user->created_at;
		$age = $user->student ? $user->student->age : '-';

		return view($this->path . 'home', ['username' => $username, 'useremail' => $useremail, 'subscription' => $subscription, 'age' => $age ]);
	}
}
