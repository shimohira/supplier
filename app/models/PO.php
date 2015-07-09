<?php

class PO extends \Eloquent {
	protected $fillable = [];
	protected $table = 'PO';
	protected $primaryKey = 'no_PO';

	public static $rules = array(
		'no_PO' => 'required|min:5s',
		'tgl_PO' => 'required',
		'no_SPPB' => 'required',
		'id_supp' => 'required',
		'ship_to' => 'required',
		);
}