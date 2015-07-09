<?php

class InvoiceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /invoice
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = DB::table('invoice')
			->select('no_inv')
			->orderBy('no_inv', 'desc')
			->first();

		$inisial = 'inv';
		if (!isset($query)) {
			$kd = $inisial.'001';

		} else {
			$kode = substr($query->no_inv, 3);
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
			'noINV' => $kd
		);

		return View::make('transaksi.invoice', $data);
		
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /invoice/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /invoice
	 *
	 * @return Response
	 */
	public function store()
	{
		/*
		public static $rules = array(
		'no_inv' => 'required|min:5s',
		'no_PO' => 'required',
		'tgl_inv' => 'required',
		'ship_by' => 'required',
		'pay_method' => 'required',
		'pelabuhan' => 'required',
		'carrier' => 'required',
		);
		*/
		$validator = Validator::make(Input::all(), Invoice::$rules);

		if($validator->fails()){
			return Redirect::to('invoice')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
				$invoice = new Invoice;
				$invoice->no_inv		= Input::get('no_inv');
				$invoice->tgl_inv		= Input::get('tgl_inv');
				$invoice->no_PO			= Input::get('no_PO');
				$invoice->ship_by		= Input::get('ship_by');
				$invoice->pay_method	= Input::get('pay_method');
				$invoice->no_rek		= Input::get('no_rek');
				$invoice->pelabuhan		= Input::get('pelabuhan');
				$invoice->carrier		= Input::get('carrier');
				$invoice->save();

				Session::flash('message', 'Successfully created invoice!');
				return Redirect::to('invoice');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /invoice/{id}
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
	 * GET /invoice/{id}/edit
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
	 * PUT /invoice/{id}
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
	 * DELETE /invoice/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}