<?php
class UsersController extends \BaseController
{
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $users = User::paginate(5);
        return View::make('users.index', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('users.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $rules = ['email'=>'required|email|unique:users','username'=>'required|alpha_dash|unique:users','password'=>'required|min:4','password_again'=>'required|same:password'];
        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            User::create(['email'=>Input::get('email'),'username'=>Input::get('username'),'password'=>Hash::make(Input::get('password'))]);
            return Redirect::route('authorized.users.index');
        }

        return Redirect::route('authorized.users.create')
            ->withInput()
            ->withErrors($validation);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $user = User::find($id);
        if (is_null($user))
        {
            return Redirect::route('authorized.users.index');
        }
        return View::make('users.show', compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user = User::find($id);
        if (is_null($user))
        {
            return Redirect::route('authorized.users.index');
        }
        return View::make('users.edit', compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $input = Input::all();
        // $rules = ['password_old'=>'required','password'=>'required|min:4','password_again'=>'required|same:password'];
        $rules = ['email'=>'required|email','password'=>'required|min:4','password_again'=>'required|same:password'];
        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {
            $user = User::find($id);
            $user->email = Input::get('email');
            $user->password = Hash::make( Input::get('password') );
            $user->save();
            return Redirect::route('authorized.users.show', $id)->with('pesan','Password telah berubah.');
        } 
        return Redirect::route('authorized.users.edit', $id)
            ->withInput()
            ->withErrors($validation);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        User::destroy($id);
        return Redirect::route('authorized.users.index');
    }

    public function postProfile()
    {
        //
    }
}
