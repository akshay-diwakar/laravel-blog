<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Route;
// use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
   public function login(){
      	return view('Backend.login');
   }

   public function dologin(Request $request){
   		// validate the info, create rules for the inputs
   		$rules = array(
   			'email' => 'required |email',  // make sure the email is an actual email
   			'password' => 'required | min:6' //password has to be greater than 6 characters
   		);

   		// run the validation rules on the inputs from the form
   		$validator = Validator::make(request()->all(),$rules);


   		//url for remember _me https://stackoverflow.com/questions/34651823/how-implement-remember-me-in-laravel-5-1 
   		// checking the value of checkbox
   		
   		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
    			return Redirect::to('admin.login')
        				->withErrors($validator) // send back all errors to the login form
       					 ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
					// create our user data for the authentication
				    $userdata = array(
				        'email'     => $request->input('email'),
				        'password'  => $request->input('password'),
				    );
				    
				    // $remember_me = $req->has('remember_me') ? true : false;

				    // attempt to do the login with also checking remeber me 
				    if (Auth::attempt($userdata)) {
					    // validation successful!
				        // redirect them to the secure section or whatever
				         // return Redirect::to('admin.dashboard');
				         return Redirect('/admin/DashBoard');
					} else {        
					    // validation not successful, send back to form 
				        return Redirect::to('Admin.login');
					}
			}

		}

		public function logout()
		  {
		  	 Auth::logout();
		     return redirect('/admin')->with('success', 'user logout successfully!');
		  }  

  
}
