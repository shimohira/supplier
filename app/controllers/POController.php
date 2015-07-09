<?php

class POController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /po
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = DB::table('PO')
			->select('no_PO')
			->orderBy('no_PO', 'desc')
			->first();

		$inisial = 'PO';
		if (!isset($query)) {
			$kd = $inisial.'001';

		} else {
			$kode = substr($query->no_PO, 2);
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
			'noPO' => $kd
		);

		return View::make('transaksi.PO' ,$data);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /po/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /po
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$validator = Validator::make(Input::all(), PO::$rules);

		if($validator->fails()){
			return Redirect::to('PO')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
				$PO = new PO;
				$PO->no_PO		= Input::get('no_PO');
				$PO->tgl_PO		= Input::get('tgl_PO');
				$PO->no_SPPB	= Input::get('no_SPPB');
				$PO->id_supp	= Input::get('id_supp');
				$PO->ship_to	= Input::get('ship_to');
				$PO->save();

				Session::flash('message', 'Successfully created PO!');
				return Redirect::to('PO');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /po/{id}
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
	 * GET /po/{id}/edit
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
	 * PUT /po/{id}
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
	 * DELETE /po/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}