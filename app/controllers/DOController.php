<?php

class DOController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /do
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = DB::table('DO')
			->select('no_DO')
			->orderBy('no_DO', 'desc')
			->first();

		$inisial = 'DO';
		if (!isset($query)) {
			$kd = $inisial.'001';

		} else {
			$kode = substr($query->no_DO, 2);
			$kode = $kode+1;
			if ($kode>0){
				$kd = $inisial.'00'.$kode;
				if ($kode>9) {
					$kd = $inisial.'0'.$kode;
					if ($kode>99) {
						$kd = $inisial.$kode;
					}
				}
			} 

		}
		
		$data = array(
			'noDO' => $kd
		);

		return View::make('transaksi.DO', $data);
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /do/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /do
	 *
	 * @return Response
	 */
	public function store()
	{

		$validator = Validator::make(Input::all(), DelO::$rules);

		if($validator->fails()){
			return Redirect::to('DO')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
				$DO = new DelO;
				$DO->no_DO	= Input::get('no_DO');
				$DO->tgl_DO	= Input::get('tgl_DO');
				$DO->no_inv	= Input::get('no_inv');
				$DO->save();

				Session::flash('message', 'Successfully created DO!');
				return Redirect::to('DO');
		}
		//
	}

	/**
	 * Display the specified resource.
	 * GET /do/{id}
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
	 * GET /do/{id}/edit
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
	 * PUT /do/{id}
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
	 * DELETE /do/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}