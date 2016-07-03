<?php

class DataTableController extends \BaseController {


	/**
	 * data Barang minimum
	 * @return mixed
	 */
	public function minBarang(){

		$pages = DB::table('barang')
			->where('jml_barang','<=','100')
			->select(array('kode_barang','nm_barang','hrg_satuan','jml_barang'));


		return Datatables::of($pages)
			->make();
	}

	//*********Start Department**********//

	public function department(){

		$pages = Department::select(array('id_dept','nm_dept'));

		
        return Datatables::of($pages)
            ->make();
	}
	//********* End Department**********//



	//*********Start Barang**********//

	public function barang(){

		$pages = DB::table('barang')->select(array('kode_barang','nm_barang', 'brand' ,'hrg_satuan','jml_barang'));

		
        return Datatables::of($pages)
            ->make();
	}
	//********* End Barang**********//


	
	//*********Start Suppler**********//
	public function supplier(){

		$pages = Supplier::select(array('id_supp','nm_supp','alamat','telp','fax'));

		
        return Datatables::of($pages)
            ->make();
	}
	//********* End Suppler**********//

	


	//*********Start STTB**********//
	public function STTB(){

		$pages = DB::table('STTB')
			->join('supplier', 'STTB.id_supp', '=', 'supplier.id_supp')
			->select(array('no_STTB','tgl_STTB','supplier.nm_supp'));
		
        return Datatables::of($pages)
            ->make();
	}

	//*********Start SPPB**********//

	public function SPPB(){

		$pages = DB::table('SPPB')
			->join('department', 'SPPB.id_dept', '=', 'department.id_dept')
			->select(array('no_SPPB','tgl_SPPB','department.nm_dept'));

        return Datatables::of($pages)
            ->make();
	}

	//***get Ajax Barang STTB/SPPB***/
	public function getBarang(){
		//sama aja
		//$id = $_GET['id'];

		$id = Input::get('id');
		$nm = Input::get('nm');
	    $result = DB::table('barang')
	    	->where('kode_barang', $id)->get();

	    foreach($result as $row) {
	        $brg = array(
	        	'kode_barang' => $row->kode_barang,
	        	'nm_barang' => $row->nm_barang,
	        	'part_number' => $row->part_number,
	        	'satuan' => $row->satuan,
	        	'brand' => $row->brand,
	        	'hrg_satuan' => $row->hrg_satuan,
	        	'jml_barang' => $row->jml_barang,
	        	'bg' => $nm,
	        	);
    	}	
    	return Response::json($brg);

	}

	//*********END STTB&SPPB**********//



	//*********Start PO**********//
	//cari SPPB
	public function SPPBpo(){

		$result = DB::table('PO')->select('no_SPPB')->get();
		$no_SPPB = [];
		foreach($result as $row) {
			array_push($no_SPPB, $row->no_SPPB);
		}

		$pages = DB::table('SPPB')
			->join('department', 'SPPB.id_dept', '=', 'department.id_dept')
			->whereNotIn('no_SPPB', $no_SPPB)
			->select(array('no_SPPB','tgl_SPPB','department.nm_dept'));

        return Datatables::of($pages)
            ->make();
	}


	//ajax get barang SPPB
	public function getSPPB(){

		$id = Input::get('id');

		$result = DB::table('detil_SPPB')
			->join('barang', 'detil_SPPB.kode_barang', '=', 'barang.kode_barang')
	    	->where('no_SPPB', $id)->get();


    	return Response::json($result);
    	/*
		$pages = DB::table('SPPB')
			->join('department', 'SPPB.id_dept', '=', 'department.id_dept')
			->select(array('no_SPPB','tgl_SPPB','department.nm_dept'));
		
        return Datatables::of($pages)
            ->make();
            */
	}


	//Print PO
	public function POfull(){

		$pages = DB::table('PO')
			->join('supplier', 'PO.id_supp', '=', 'supplier.id_supp')
			->select(array('no_PO','tgl_PO','supplier.nm_supp'));
		
        return Datatables::of($pages)
            ->make();
	}
	//********* End PO**********//



	//*********Start invoice**********//

	//cari PO
	public function PO(){

		$result = DB::table('invoice')->select('no_PO')->get();
		$no_PO = [];
		foreach($result as $row) {
			array_push($no_PO, $row->no_PO);
		}

		$pages = DB::table('PO')
			->join('supplier', 'PO.id_supp', '=', 'supplier.id_supp')
			->whereNotIn('no_PO', $no_PO)
			->select(array('no_PO','tgl_PO','supplier.nm_supp'));
		
        return Datatables::of($pages)
            ->make();
	}


	//list Print Invoice
	public function invfull(){

			$pages = DB::table('invoice')
			->join('PO', 'PO.no_PO', '=', 'invoice.no_PO')
			->join('supplier', 'PO.id_supp', '=', 'supplier.id_supp')
			->select(array('no_inv','tgl_inv','PO.no_PO','PO.tgl_PO','supplier.nm_supp'));
		
        return Datatables::of($pages)
            ->make();
	}

	//ajax Get PO
	public function getPO(){

		$id = Input::get('id');

		$result = DB::table('PO')
			->join('detil_SPPB', 'detil_SPPB.no_SPPB', '=', 'PO.no_SPPB')
			->join('barang', 'detil_SPPB.kode_barang', '=', 'barang.kode_barang')
	    	->where('no_PO', $id)->get();

    	return Response::json($result);
	}

	
	//********* End invoice**********//
	


	//*********Start DO**********//
	//cari Invoice
	public function inv(){

		$result = DB::table('DO')->select('no_inv')->get();
		$no_inv = [];
		foreach($result as $row) {
			array_push($no_inv, $row->no_inv);
		}

		$pages = DB::table('invoice')
			->join('PO', 'PO.no_PO', '=', 'invoice.no_PO')
			->join('supplier', 'PO.id_supp', '=', 'supplier.id_supp')
			->whereNotIn('no_inv', $no_inv)
			->select(array('no_inv','tgl_inv','PO.no_PO','PO.tgl_PO','supplier.nm_supp'));
		
        return Datatables::of($pages)
            ->make();
	}

	//ajax get Invoice
	public function getinv(){

		$id = Input::get('id');

		$result = DB::table('invoice')
			->join('PO', 'invoice.no_PO', '=', 'PO.no_PO')
			->join('detil_SPPB', 'detil_SPPB.no_SPPB', '=', 'PO.no_SPPB')
			->join('barang', 'detil_SPPB.kode_barang', '=', 'barang.kode_barang')
			->join('supplier', 'PO.id_supp', '=', 'supplier.id_supp')
	    	->where('no_inv', $id)->get();

    	return Response::json($result);
	}

	//list print DO
	public function DelO(){

		$pages = DB::table('DO')
			->join('invoice', 'DO.no_inv', '=', 'invoice.no_inv')
			->join('PO', 'invoice.no_PO', '=', 'PO.no_PO')
			->select(array('no_DO','tgl_DO','invoice.no_inv','PO.no_PO'));
		
        return Datatables::of($pages)
            ->make();
	}	
	//********* End DO**********//

}