<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return redirect('/users');
        }
        else {
            $validator->errors()->add('password', 'Your credentials are invalid.');
            return redirect('/')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }
    }
}
