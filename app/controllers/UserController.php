<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('login');
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('daftar');
		//
	}

	public function postCreate() {

		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			$user = new User;
			$user->nama = Input::get('nama');
			$user->no_kar = Input::get('no_kar');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::route('login')->with('message', 'Thanks for registering!');
        // validation has passed, save user in DB
		} else {
			return Redirect::route('daftar')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        // validation has failed, display error messages    
		}
	}

	public function postSignin() {
		$user = array('username'=>Input::get('username'), 'password'=>Input::get('password'));

		if (Auth::attempt($user)) {
			return Redirect::route('index')->with('message', 'You are now logged in!');
		} else {
			return Redirect::route('login')
			->with('message', 'Your username/password combination was incorrect')
			->withInput();
		}
	}
	
	public function getLogout(){
		Auth::logout();
		return Redirect::route('login')->with('message', 'Your are now logged out!');
		
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}