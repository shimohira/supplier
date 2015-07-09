<?php

class Supplier extends \Eloquent {
	protected $fillable = [];
	protected $table = 'supplier';
	protected $primaryKey = 'id_supp';

	public static $rules = array(
		'id_supp'	=> 'required|min:5s',
		'nm_supp'	=> 'required',
		'alamat'	=> 'required',
		'telp'		=> 'numeric|required|regex:/[0-9]{10,13}/',
		'fax'		=> 'numeric|required|regex:/[0-9]{7,13}/'
		);
}