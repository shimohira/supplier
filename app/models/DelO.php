<?php

class DelO extends \Eloquent {
	protected $fillable = [];
	protected $table = 'DO';
	protected $primaryKey = 'no_DO';

	public static $rules = array(
		'no_DO' => 'required|min:5s',
		'tgl_DO' => 'required',
		'no_inv' => 'required'
		);
}