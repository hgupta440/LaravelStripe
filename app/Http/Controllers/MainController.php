<?php

namespace App\Http\Controllers;

use Redirect;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
   
    public function login()
    {
        $rules = array(
                      'email' => 'required|email',
                      'password' => 'required'
                );
  
        $validator = Validator::make(Request::all() , $rules);
        if ($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else{
    
            $userdata = array(
              'email' => Request::get('email') ,
              'password' => Request::get('password')
            );
            if (Auth::attempt($userdata)){
                return Redirect::to("/product");
            }else{
                return Redirect::back()->withErrors(['login' => 'Email or password is not correct']);
            }
        }
    }
}