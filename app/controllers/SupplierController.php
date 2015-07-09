<?php

class SupplierController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /supplier
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = DB::table('supplier')
			->select('id_supp')
			->orderBy('id_supp', 'desc')
			->first();

		$inisial = 'SP';
		if (!isset($query)) {
			$kd = $inisial.'001';

		} else {
			$kode = substr($query->id_supp, 2);
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
			'id_supp' => $kd
		);
		return View::make('master.supplier',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /supplier/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /supplier
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Supplier::$rules);

		if($validator->fails()){
			return Redirect::to('supplier')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			if (Supplier::where('id_supp', '=', Input::get('id_supp'))->exists()) {

				$supplier = Supplier::find(Input::get('id_supp'));
				$supplier->nm_supp	= Input::get('nm_supp');
				$supplier->alamat	= Input::get('alamat');
				$supplier->telp		= Input::get('telp');
				$supplier->fax		= Input::get('fax');
				$supplier->save();

				Session::flash('message', 'Successfully updated supplier!');
				return Redirect::to('supplier');
			} else {
				$supplier = new Supplier;
				$supplier->id_supp	= Input::get('id_supp');
				$supplier->nm_supp	= Input::get('nm_supp');
				$supplier->alamat	= Input::get('alamat');
				$supplier->telp		= Input::get('telp');
				$supplier->fax		= Input::get('fax');
				$supplier->save();

				Session::flash('message', 'Successfully created supplier!');
				return Redirect::to('supplier');
				
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /supplier/{id}
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
	 * GET /supplier/{id}/edit
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
	 * PUT /supplier/{id}
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
	 * DELETE /supplier/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$barang = Supplier::find($id);
		$barang->delete();

        // redirect
		Session::flash('message', 'Successfully deleted supplier!');
		return Redirect::to('supplier');
		//
	}

}