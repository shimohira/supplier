<?php

class SiteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /site
	 *
	 * @return Response
	 */
	public function index() {
		$data = array(
			'barang' => Barang::where('jml_barang','<=','10')
							->get(),
			'user' => User::all()
			);
		return View::make('index', $data);
		//
	}

	public function profile() {

		$data = array(
			'user' => User::where('username',Auth::user()->username)
						->get(),
			);
		return View::make('profile',$data);
	}

	public function dashboard() {
		return View::make('dashboard');
	}

	public function prfSave() {

		$nama = Input::get('nama');

		$user = User::find(Auth::user()->no_kar);
		$user->nama		= Input::get('nama');
		$user->save();

		$respon = array(
			'nama' => $nama,
			);

    	return Response::json($respon);
	}

	public function pwdSave() {

		$pwdOld = Input::get('pwdOld');
		$pwdNew = Input::get('pwdNew');
		$pwdCnf = Input::get('pwdCnf');
		if ($pwdNew) {
			if (Hash::check($pwdOld, Auth::user()->password)) {
				if ($pwdNew==$pwdCnf) {
					$user = User::find(Auth::user()->no_kar);
					$user->password		= Hash::make($pwdNew);
					$user->save();
					$massage = 'success mengubah password';
				} else {
					$massage = 'password confirm salah' ;
				}
			} else {
				$massage = 'password lama salah';
			}
		} else {
			$massage = 'password harus di isi' ;
		}

		

		$respon = array(
			'nama' => $massage,
			);

    	return Response::json($respon);
	}


	public function testprint() {
		//$users = App\Models\User::orderBy('name')->get();
		
		$data = array(
			'coba' => 'asik');
   		$pdf   = PDF::loadView('reports.SPPB', $data);
 
   		return $pdf->stream();
   		/*
		$pdf = App::make('dompdf');
		$pdf->loadHTML('<h1>Test</h1>');
		return $pdf->stream();
		*/
	}
	
	public function ajax(){
		return View::make('latihan.ajax');
	}

	public function request(){
		return View::make('latihan.request');
	}

	public function pengadaan()
	{
		return View::make('pengadaan');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /site/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /site
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /site/{id}
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
	 * GET /site/{id}/edit
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
	 * PUT /site/{id}
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
	 * DELETE /site/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}