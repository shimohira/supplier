<?php

class BarangController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /barang
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = DB::table('barang')
			->select('kode_barang')
			->orderBy('kode_barang', 'desc')
			->first();

		$inisial = 'BR';
		if (!isset($query)) {
			$kd = $inisial.'001';

		} else {
			$kode = substr($query->kode_barang, 2);
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
			'kdBarang' => $kd
		);

		return View::make('master.barang', $data);
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /barang/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /barang
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Barang::$rules);

		if($validator->fails()){
			return Redirect::to('barang')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			if (Barang::where('kode_barang', '=', Input::get('kode_barang'))->exists()) {

				$barang = Barang::find(Input::get('kode_barang'));
				$barang->nm_barang		= Input::get('nm_barang');
				$barang->satuan			= Input::get('satuan');
				$barang->part_number	= Input::get('part_number');
				$barang->brand			= Input::get('brand');
				$barang->hrg_satuan		= Input::get('hrg_satuan');
				$barang->jml_barang		= Input::get('jml_barang');
				$barang->save();

				Session::flash('message', 'Successfully updated barang!');
				return Redirect::to('barang');
			} else {
				$barang = new Barang;
				$barang->kode_barang	= Input::get('kode_barang');
				$barang->nm_barang		= Input::get('nm_barang');
				$barang->part_number	= Input::get('part_number');
				$barang->satuan			= Input::get('satuan');
				$barang->brand			= Input::get('brand');
				$barang->hrg_satuan		= Input::get('hrg_satuan');
				$barang->jml_barang		= Input::get('jml_barang');
				$barang->save();

				Session::flash('message', 'Successfully created barang!');
				return Redirect::to('barang');
				
			}
		}
		//
	}

	/**
	 * Display the specified resource.
	 * GET /barang/{id}
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
	 * GET /barang/{id}/edit
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
	 * PUT /barang/{id}
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
	 * DELETE /barang/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$barang = Barang::find($id);
		$barang->delete();

        // redirect
		Session::flash('message', 'Successfully deleted barang!');
		return Redirect::to('barang');
		//
	}

}