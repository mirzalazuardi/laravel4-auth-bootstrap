<?php

class ProfileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('profile.index');
	}

	public function getChange_password()
	{
		$user = Auth::user();
		return View::make('profile.change_password',compact('user'));
	}

	/**
     * Update password
     *
     * @param  int  $id
     * @return Response
     */
    public function postChange_password() {
        $input = Input::all();
        $rules = ['password_old'=>'required','password'=>'required|min:4','password_again'=>'required|same:password'];
        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {
            $user = Auth::user();
            if( Hash::check( Input::get('password_old'), $user->password ) )  {
                //matched password with old password
                $user->password = Hash::make( Input::get('password') );
                $user->save();
                return Redirect::to('profile/show')->with('pesan','Password telah berubah.');
            } else {
                //not matched
                return Redirect::to('profile/change_password')
                                                            ->withInput()
                                                            ->withErrors($validation)
                                                            ->with('pesan','Password salah.');
            }
        } 
        return Redirect::to('profile/change_password')
            ->withInput()
            ->withErrors($validation);
    }

    /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$user = Auth::user();
		return View::make('profile.show',compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$user = Auth::user();
        return View::make('profile.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update() {
	$input = Input::all();
        $rules = ['email'=>'required|email|unique:users'];
        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {
            $user = Auth::user();
            $user->email = Input::get('email');
            $user->save();
            return Redirect::to('profile/show')->with('pesan','Data telah berubah & disimpan.');
        } 
        return Redirect::to('profile/edit')
            ->withInput()
            ->withErrors($validation);
    }

}
