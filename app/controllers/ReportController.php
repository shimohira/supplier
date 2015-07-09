<?php

class ReportController extends \BaseController {


	public function SPPB($id) {


		$data = array(
			'id' 	=> 	$id,
			'data'	=>	Barang::join('detil_SPPB', 'barang.kode_barang', '=','detil_SPPB.kode_barang' )
							->join('SPPB','detil_SPPB.no_SPPB','=','SPPB.no_SPPB')
							->join('users','SPPB.no_kar','=','users.no_kar')
							->where('detil_SPPB.no_SPPB','=',$id)
							->select('nm_barang','jml_pesan','hrg_satuan', 'nama')
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
							->select('nm_barang','jml_beli','hrg_satuan', 'nama')
							->get()
		);
   		$pdf   = PDF::loadView('reports.STTB', $data)->setPaper('a4','landscape');
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
		$data = array(
			'id' 	=> 	$id,
			'data'	=>	Barang::join('detil_SPPB', 'barang.kode_barang', '=','detil_SPPB.kode_barang' )
							->join('detil_STTB', 'barang.kode_barang', '=','detil_STTB.kode_barang' )
							->join('SPPB', 'detil_SPPB.no_SPPB', '=','SPPB.no_SPPB' )
							->join('STTB', 'detil_STTB.no_STTB', '=','STTB.no_STTB' )
							->where(DB::raw("YEAR(tgl_SPPB)"),$id)
							->where(DB::raw("YEAR(tgl_STTB)"),$id)
							->select(DB::raw('distinct(barang.kode_barang)'),'nm_barang','satuan','jml_barang',DB::raw('sum(jml_pesan) AS total_pesan')
								,DB::raw('sum(jml_beli) AS total_beli'))
							->groupBy('barang.kode_barang')
							->get()
		);
   		$pdf   = PDF::loadView('reports.rekap', $data)->setPaper('a4','landscape');
 
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

	public function lapSPPB($awal,$akhir) {
		$data = array(
			'awal'	=> $awal,
			'akhir'	=> $akhir,
			'data'	=>	Barang::join('detil_SPPB', 'barang.kode_barang', '=','detil_SPPB.kode_barang' )
							->join('SPPB', 'detil_SPPB.no_SPPB', '=','SPPB.no_SPPB' )
							->join('PO','SPPB.no_SPPB','=','PO.no_SPPB')
							->join('supplier','PO.id_supp','=','supplier.id_supp')
							->whereBetween('tgl_SPPB', array($awal, $akhir))
							->select('nm_barang','barang.kode_barang','satuan',DB::raw('sum(jml_pesan) AS total_pesan')
								,'nm_supp','brand','hrg_satuan')
							->groupBy('barang.kode_barang')
							->get()
		);
   		$pdf   = PDF::loadView('reports.lapSPPB', $data)->setPaper('a4','potrait');
 
   		return $pdf->stream();
	}


}