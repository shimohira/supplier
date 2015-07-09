<?php

class Department extends \Eloquent {
	protected $fillable = [];
	protected $table = 'department';
	protected $primaryKey = 'id_dept';

	public static $rules = array(
		'id_dept' => 'required|min:5s',
		'nm_dept' => 'required'
		);
}