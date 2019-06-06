<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{

    public function login($request)
    {
        $loginCred = $request->only('email','password');

        $loginRule = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validate = Validator::make($loginCred, $loginRule);
        if($validate->fails()) {
             return response()->json(['user'=> false, 'error'=> $validator->messages()]);
        }

        try {
           // attempt to verify the credentials and create a token for the user
           if (! $token = JWTAuth::attempt($loginCred)) {
               return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
           }
       } catch (JWTException $e) {
           // something went wrong whilst attempting to encode the token
           return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
       }


        return $this->respondWithToken($token);



       return response()->json(['success' => true, 'data'=> [ 'token' => $token ]]);

    }





}
