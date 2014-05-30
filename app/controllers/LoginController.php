<?php

class LoginController extends \BaseController {
    /**
     * Login
     * @return redirect view
     */
    public function getLogin() {
        if( Auth::check() ) {
            if (Auth::user()->username=='admin') {
                return Redirect::route('authorized.users.index');
            } else {
                return Redirect::to('profile/user');
            }
        }    
        return View::make('login.index');
    }
    
    /**
     * proses Login
     * @return redirect view
     */
    public function postLogin() {
        $data = Input::all();
        $rules = array('email' => 'required|email', 'password' => 'required');
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            if(Request::ajax()) {
                return Response::json($validator->getMessageBag());
            } else {
                return Redirect::route('login')->withErrors($validator)->withInput();
            }
        } else {
            
            $credential = ['email' => Input::get('email'), 'password' => Input::get('password') ];
            
            if (!Auth::attempt($credential)) {
                if(Request::ajax()){
                	return Response::json(['pesan'=>'Password Salah']);
                } else {
                    Return Redirect::Route('login')->with('pesan', 'Password salah')->withInput();
                }
            } 
        }     
        if(Request::ajax()){
            return Response::json(['pesan'=>'sukses']);
        } else {
            return Redirect::to('login');
        }
    }

    public function getLogout()
    {
    	Auth::logout();
    	return Redirect::route('login');
    }

}
