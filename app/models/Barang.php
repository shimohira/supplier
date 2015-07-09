<?php

class Barang extends \Eloquent {
	protected $fillable = [];
	protected $table = 'barang';
	protected $primaryKey = 'kode_barang';

	public static $rules = array(
		'kode_barang' => 'required|min:5s',
		'nm_barang' => 'required',
		'satuan' => 'required',
		'brand' => 'required',
		'hrg_satuan' => 'numeric|required',
		'jml_barang' => 'required|numeric'
		);
}