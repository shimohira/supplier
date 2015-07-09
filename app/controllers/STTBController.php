<?php

class STTBController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /sttb
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = DB::table('STTB')
			->select('no_STTB')
			->orderBy('no_STTB', 'desc')
			->first();

		$inisial = 'STB';
		if (!isset($query)) {
			$kd = $inisial.'001';

		} else {
			$kode = substr($query->no_STTB, 3);
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
			'supplier' => Supplier::lists('nm_supp', 'id_supp') , 
			'noSTTB' => $kd
		);

		return View::make('transaksi.STTB' ,$data);
	}

	public function simpan1() {

		$no_STTB = Input::get('noSTTB');
		$id_supp = Input::get('idSupp');
		$tgl_STTB = Input::get('tglSTTB');

		$STTB = new STTB;
		$STTB->no_STTB		= $no_STTB;
		$STTB->tgl_STTB		= $tgl_STTB;
		$STTB->id_supp		= $id_supp;
		$STTB->no_kar		= Auth::user()->no_kar;
		$STTB->save();
		/*
		DB::table('STTB')->insert(
			array('no_STTB' => $no_STTB, 'tgl_STTB' => $tgl_STTB, 'id_supp' => $id_supp)
			);
*/
		$brg = array(
			'confirm' => 'succes',
			);

    	return Response::json($brg);;
	}

	public function simpan2() {

		$detilSTTB = new DetilSTTB;
		$detilSTTB->no_STTB		= Input::get('noSTTB');
		$detilSTTB->kode_barang	= Input::get('kd_brg');
		$detilSTTB->jml_beli	= Input::get('jml_beli');
		$detilSTTB->ket			= Input::get('ket');
		$detilSTTB->save();

		$barang = Barang::find(Input::get('kd_brg'));
		$barang->jml_barang		= $barang->jml_barang+Input::get('jml_beli');
		$barang->save();

		$brg = array(
			'confirm' => 'succes',
			);

    	Session::flash('message', 'Successfully created STTB!');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /sttb/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sttb
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /sttb/{id}
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
	 * GET /sttb/{id}/edit
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
	 * PUT /sttb/{id}
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
	 * DELETE /sttb/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}