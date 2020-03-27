<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registrationController extends Controller
{
    public function create(){

    }

    public function store(){

      //validate
      $this->validate(request(),[

            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required'

         ]);

      //create & save the user
      $propagent=propagent::create(request(['name','email','password']))

      //sign them in
      auth()->login($propagent);

      //redirect
      return redirect()->login();

    }
}
