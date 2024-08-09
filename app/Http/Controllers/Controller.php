<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /* public function login(Request $request) {
        if($request->isMethod('get')) {
            return view('login');
        } else {
            $validate = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            $user = User::where('username', $request['username'])->first();
            if (!$user) {
                Session::flash('error', 'Invalid credentialsss');
                return back();
            }

            if (Auth::attempt(['username' => $user->username, 'password' => $request->password])) {
                Auth::loginUsingId($user->id);
                return redirect('/');
                // return redirect()->route('orders');
            } else {
                Session::flash('error', 'Invalid credentials');
                return back();
            }
        }
    } */
}
