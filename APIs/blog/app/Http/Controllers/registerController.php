<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class registerController extends Controller
{
    public function register(Request $request)
    {
          $requestRange = $request->only('name', 'email', 'password');
          $validates = [
              'name' => 'required|min:3|max:255',
              'email' => 'required|email|max:255|unique:users',
              'password'=> 'required|min:6'
            ];

          $validator = Validator::make($requestRange, $validates);
          if($validator->fails()) {
                return response()->json(['success'=> false, 'error'=> $validator->messages()]);
          }

          $user = User::create([
             'name' => $request['name'],
             'email' => $request['email'],
             'password' => bcrypt($request['password']),
             'api_token'=>str_random(60)
           ]);

          return response()->json(['User'=>$user , 'message'=> 'Thanks for signing up!']);
    }



}
