<?php

class ReportController extends \BaseController {


	public function SPPB($id) {


		$data = array(
			'id' 	=> 	$id,
			'data'	=>	Barang::join('detil_SPPB', 'barang.kode_barang', '=','detil_SPPB.kode_barang' )
							->join('SPPB','detil_SPPB.no_SPPB','=','SPPB.no_SPPB')
							->join('users','SPPB.no_kar','=','users.no_kar')
							->where('detil_SPPB.no_SPPB','=',$id)
							->select('barang.kode_barang','nm_barang','jml_pesan','hrg_satuan', 'nama', 'brand','satuan','part_number')
							->get()
		);
   		$pdf   = PDF::loadView('reports.SPPB', $data);
 
   		return $pdf->stream();
	}

	public function STTB($id) {

		$data = array(
			'id' 	=> 	$id,
			'data'	=>	Barang::join('detil_STTB', 'barang.kode_barang', '=','detil_STTB.kode_barang' )
							->join('STTB','detil_STTB.no_STTB','=','STTB.no_STTB')
							->join('users','STTB.no_kar','=','users.no_kar')
							->where('detil_STTB.no_STTB','=',$id)
							->select('barang.kode_barang','nm_barang','jml_beli','hrg_satuan', 'nama', 'brand', 'satuan','part_number')
							->get()
		);
   		$pdf   = PDF::loadView('reports.STTB', $data)->setPaper('a4');
   		//return $pdf->download('STTB.pdf');
   		return $pdf->stream();
	}

	public function PO($id) {
		$data = array(
			'id' 	=> 	$id,
			'data'	=>	Barang::join('detil_SPPB', 'barang.kode_barang', '=','detil_SPPB.kode_barang' )
							->join('SPPB','detil_SPPB.no_SPPB','=','SPPB.no_SPPB')
							->join('PO','SPPB.no_SPPB','=','PO.no_SPPB')
							->join('supplier','PO.id_supp','=','supplier.id_supp')
							->where('PO.no_PO','=',$id)
							->select('barang.kode_barang','nm_barang','jml_pesan','satuan','hrg_satuan','nm_supp','alamat','fax','telp'
								,'ship_to','no_PO','tgl_PO','SPPB.no_SPPB')
							->get()
							
		);
   		$pdf   = PDF::loadView('reports.PO', $data)->setPaper('a4','landscape');
 
   		return $pdf->stream();
	}

	public function inv($id) {
		$data = array(
			'id' 	=> 	$id,
			'data'	=>	Barang::join('detil_SPPB', 'barang.kode_barang', '=','detil_SPPB.kode_barang' )
							->join('SPPB','detil_SPPB.no_SPPB','=','SPPB.no_SPPB')
							->join('PO','SPPB.no_SPPB','=','PO.no_SPPB')
							->join('supplier','PO.id_supp','=','supplier.id_supp')
							->join('invoice','PO.no_PO','=','invoice.no_PO')
							->where('invoice.no_inv','=',$id)
							->select('barang.kode_barang','nm_barang' ,'part_number','jml_pesan','satuan','hrg_satuan','nm_supp','alamat','fax','telp'
								,'ship_by','ship_to','PO.no_PO','tgl_PO','SPPB.no_SPPB', 'invoice.no_inv', 'pay_method','no_rek', 'pelabuhan' ,'carrier', 'tgl_inv', 'city')
							->get()
							
		);
   		$pdf   = PDF::loadView('reports.inv', $data)->setPaper('a4');
 
   		return $pdf->stream();
	}

	public function DelO($id) {
		$data = array(
			'id' 	=> 	$id,
			'data'	=>	Barang::join('detil_SPPB', 'barang.kode_barang', '=','detil_SPPB.kode_barang' )
							->join('SPPB','detil_SPPB.no_SPPB','=','SPPB.no_SPPB')
							->join('PO','SPPB.no_SPPB','=','PO.no_SPPB')
							->join('supplier','PO.id_supp','=','supplier.id_supp')
							->join('invoice','PO.no_PO','=','invoice.no_PO')
							->join('DO','invoice.no_inv','=','DO.no_inv')

							->where('DO.no_DO','=',$id)
							->select('barang.kode_barang','nm_barang','jml_pesan','satuan','hrg_satuan','nm_supp','alamat','fax','telp'
								,'ship_to','PO.no_PO','tgl_PO','SPPB.no_SPPB','DO.no_DO')
							->get()
							
		);
   		$pdf   = PDF::loadView('reports.DO', $data)->setPaper('a4','landscape');
 
   		return $pdf->stream();
	}

	public function rekap($id) {

		$pesan = DetilSPPB::join('barang','barang.kode_barang','=','detil_SPPB.kode_barang')
						->join('SPPB', 'detil_SPPB.no_SPPB', '=','SPPB.no_SPPB')
						->join('PO','SPPB.no_SPPB','=','PO.no_SPPB')
						->join('invoice','PO.no_PO','=','invoice.no_PO')
						->selectRaw('barang.kode_barang,sum(jml_pesan) AS pesan, nm_barang, satuan, jml_barang, tgl_SPPB, brand')
						->groupBy('kode_barang');
		
		$beli = DetilSTTB::join('barang','barang.kode_barang','=','detil_STTB.kode_barang')
						->join('STTB', 'detil_STTB.no_STTB', '=','STTB.no_STTB')
						->selectRaw('barang.kode_barang, sum(jml_beli) AS beli, nm_barang, satuan, jml_barang, tgl_STTB, brand')
						->groupBy('kode_barang');
		$first = DB::table(DB::raw("({$pesan->toSql()}) as sub1"))
					->join(DB::raw("({$beli->toSql()}) as sub2"), 'sub2.kode_barang','=','sub1.kode_barang','left')
					->where(DB::raw("YEAR(sub1.tgl_SPPB)"),$id)
					->selectRaw('sub1.kode_barang, sub1.pesan, sub2.beli, sub1.nm_barang, sub1.satuan, sub1.jml_barang, sub1.brand');
		$data = array(
			'id' 	=> 	$id,
			'data'	=>	DB::table(DB::raw("({$pesan->toSql()}) as sub1"))
						->join(DB::raw("({$beli->toSql()}) as sub2"), 'sub2.kode_barang','=','sub1.kode_barang','right')
						->where(DB::raw("YEAR(sub2.tgl_STTB)"),$id)
						->selectRaw('sub2.kode_barang, sub1.pesan, sub2.beli, sub2.nm_barang, sub2.satuan, sub2.jml_barang, sub2.brand')
						->union($first)
						->get()
                		
		);

   		$pdf   = PDF::loadView('reports.rekap', $data)->setPaper('a4','landscape')->save('myfile.pdf');
 
   		return $pdf->stream();
	}

	public function lapinvo($awal,$akhir) {
		$data = array(
			'awal'	=> $awal,
			'akhir'	=> $akhir,
			'data'	=> Invoice::join('PO','invoice.no_PO','=','PO.no_PO')
							->join('supplier','PO.id_supp','=','supplier.id_supp')
							->whereBetween('tgl_inv', array($awal, $akhir))
							->get()
		);
   		$pdf   = PDF::loadView('reports.lapinvo', $data)->setPaper('a4','potrait');
 
   		return $pdf->stream();
	}

	public function lapSTTB($awal,$akhir) {
		$data = array(
			'awal'	=> $awal,
			'akhir'	=> $akhir,
			'data'	=>	Barang::join('detil_STTB', 'barang.kode_barang', '=','detil_STTB.kode_barang' )
							->join('STTB', 'detil_STTB.no_STTB', '=','STTB.no_STTB' )
							->join('supplier', 'STTB.id_supp', '=','supplier.id_supp' )
							->whereBetween('tgl_STTB', array($awal, $akhir))
							->select('nm_barang','barang.kode_barang','satuan',DB::raw('sum(jml_beli) AS total_beli')
								,'nm_supp','brand')
							->groupBy('barang.kode_barang')
							->get()
		);
   		$pdf   = PDF::loadView('reports.lapSTTB', $data)->setPaper('a4','potrait');
 
   		return $pdf->stream();
	}
/*

*/
	public function lapSPPB($awal,$akhir) {
		$data = array(
			'awal'	=> $awal,
			'akhir'	=> $akhir,
			'data'	=>	Barang::join('detil_SPPB', 'barang.kode_barang', '=','detil_SPPB.kode_barang' )
							->join('SPPB', 'detil_SPPB.no_SPPB', '=','SPPB.no_SPPB' )
							->join('PO','SPPB.no_SPPB','=','PO.no_SPPB')
							->join('invoice','PO.no_PO','=','invoice.no_PO')
							->join('supplier','PO.id_supp','=','supplier.id_supp')
							->whereBetween('tgl_SPPB', array($awal, $akhir))
							->select('nm_barang','barang.kode_barang','satuan',DB::raw('sum(jml_pesan) AS total_pesan')
								,'nm_supp','brand','hrg_satuan')
							->groupBy('kode_barang')
							->get()
		);
   		$pdf   = PDF::loadView('reports.lapSPPB', $data)->setPaper('a4','potrait');
 
   		return $pdf->stream();
	}

	/**
	 * Laporang Stock barang
	 */
	public function lapStock() {
		$data = array(
			'data'	=>	Barang::all()
		);
   		$pdf   = PDF::loadView('reports.lapStock', $data)->setPaper('a4','potrait');
 
   		return $pdf->stream();
	}


}