<?php

class DepartmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /department
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = DB::table('department')
			->select('id_dept')
			->orderBy('id_dept', 'desc')
			->first();

		$inisial = 'DP';
		if (!isset($query)) {
			$kd = $inisial.'001';

		} else {
			$kode = substr($query->id_dept, 2);
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
			'id_dept' => $kd
		);

		return View::make('master.department', $data);
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /department/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /department
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Department::$rules);

		$row = Department::where('id_dept', '=', Input::get('id_dept'));

		if($validator->fails()){
			return Redirect::to('department')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			if (Department::where('id_dept', '=', Input::get('id_dept'))->exists()) {

				$department = Department::find(Input::get('id_dept'));
				$department->nm_dept  	= Input::get('nm_dept');
				$department->save();

				Session::flash('message', 'Successfully updated Department!');
				return Redirect::to('department');
			} else {
				$department = new Department;
				$department->id_dept	= Input::get('id_dept');
				$department->nm_dept	= Input::get('nm_dept');
				$department->save();

				Session::flash('message', 'Successfully created Department!');
				return Redirect::to('department');
				
			}
		}
		//
	}

	/**
	 * Display the specified resource.
	 * GET /department/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Redirect::to('department');
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /department/{id}/edit
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
	 * PUT /department/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return Redirect::to('department');
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /department/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$barang = Department::find($id);
		$barang->delete();

        // redirect
		Session::flash('message', 'Successfully deleted Department!');
		return Redirect::to('department');
		//
	}

}