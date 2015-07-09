<?php

class SPPBController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /sppb
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = DB::table('SPPB')
			->select('no_SPPB')
			->orderBy('no_SPPB', 'desc')
			->first();

		$inisial = 'SPB';
		if (!isset($query)) {
			$kd = $inisial.'001';

		} else {
			$kode = substr($query->no_SPPB, 3);
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
			'department' => Department::lists('nm_dept', 'id_dept') , 
			'noSPPB' => $kd
		);

		return View::make('transaksi.SPPB' ,$data);
	}

	public function simpan1() {

		$no_SPPB = Input::get('noSPPB');
		$id_dept = Input::get('idDept');
		$tgl_SPPB = Input::get('tglSPPB');

		$SPPB = new SPPB;
		$SPPB->no_SPPB		= $no_SPPB;
		$SPPB->tgl_SPPB		= $tgl_SPPB;
		$SPPB->id_dept		= $id_dept;
		$SPPB->no_kar		= Auth::user()->no_kar;
		$SPPB->save();
		/*
		DB::table('SPPB')->insert(
			array('no_SPPB' => $no_SPPB, 'tgl_SPPB' => $tgl_SPPB, 'id_dept' => $id_dept)
			);
*/
		$brg = array(
			'confirm' => 'succes',
			);

    	return Response::json($brg);;
	}

	public function simpan2() {

		$detilSPPB = new DetilSPPB;
		$detilSPPB->no_SPPB		= Input::get('noSPPB');
		$detilSPPB->kode_barang	= Input::get('kd_brg');
		$detilSPPB->jml_pesan	= Input::get('jml_pesan');
		$detilSPPB->ket			= Input::get('ket');
		$detilSPPB->save();

		$barang = Barang::find(Input::get('kd_brg'));
		$barang->jml_barang		= $barang->jml_barang-Input::get('jml_pesan');
		$barang->save();

		$brg = array(
			'confirm' => 'succes',
			);

    	Session::flash('message', 'Successfully created SPPB!');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /sppb/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sppb
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /sppb/{id}
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
	 * GET /sppb/{id}/edit
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
	 * PUT /sppb/{id}
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
	 * DELETE /sppb/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}