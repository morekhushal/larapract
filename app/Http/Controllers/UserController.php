<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class UserController extends Controller
{
    public function login(Request $request) {
        if($request->isMethod('get')) {
            return view('login');
        } else {
            $validate = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            // return $request->all();
            if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
                return redirect()->route('loan-details');
            } else {
                Session::flash('error', 'Invalid credentials');
                return back();
            }
        }
    }
    public function logout() {
        Auth::logout();
        return redirect('login');
    }
    /* public function userHome() {
        $products = Product::get();
        return view('user_home', compact('products'));
    }

    

     */
}
