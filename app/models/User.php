<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'no_kar';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static $rules = array(
		'nama'=>'required|min:2',
		'no_kar'=>'required|between:5,7',
		'username'=>'required|alpha|min:5|unique:users',
		'password'=>'required|alpha_num|between:5,12|confirmed',
		'password_confirmation'=>'required|alpha_num|between:5,12'
		);

}
