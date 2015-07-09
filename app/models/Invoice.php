<?php

class Invoice extends \Eloquent {
	protected $fillable = [];
	protected $table = 'invoice';
	protected $primaryKey = 'no_inv';

	public static $rules = array(
		'no_inv' => 'required|min:5s',
		'no_PO' => 'required',
		'tgl_inv' => 'required',
		'ship_by' => 'required',
		'pay_method' => 'required',
		'no_rek' => 'required|numeric',
		'pelabuhan' => 'required',
		'carrier' => 'required',
		);
}