<?php

class LaporanController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /laporan
	 *
	 * @return Response
	 */
	public function rekap()
	{
		return View::make('laporan.rekap');
		//
	}
	public function lapinvo(){
		return View::make('laporan.lapinvo');
	}

	public function lapSTTB(){
		return View::make('laporan.lapSTTB');
	}
	public function lapSPPB(){
		return View::make('laporan.lapSPPB');
	}
	public function lapStock(){
		return View::make('laporan.lapStock');
	}

	public function lapPO(){
		return View::make('laporan.lapPO');
	}

	public function lapDO(){
		return View::make('laporan.lapDO');
	}
}