<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
example 

Route::group(array('before' => 'guest'), function(){
	Route::get('login',array('as' => 'login', 'uses'=>'UserController@index'));
	Route::get('daftar',array('as' => 'daftar', 'uses'=>'UserController@create'));
});

Route::group(array('before' => 'auth'), function() {
	Route::get('/',array('as' => 'home', 'uses'=> 'HomeController@index'));
	Route::get('logout',array('as' => 'logout', 'uses'=> 'UserController@getLogout'));
	Route::resource('barang', 'BarangController');
	Route::get('pegawai',array('as' => 'pegawai', 'uses'=> 'PegawaiController@index'));
	Route::get('pegawai/data',array('as'=>'pegData','uses'=>'PegawaiController@getTable'));
	Route::get('customer',array('as'=>'customer','uses'=>'CustomerController@index'));
});

Route::group(array('before' => 'csrf'), function(){
	Route::post('user/create',array('as' => 'PostCreate', 'uses'=>'UserController@postCreate'));
	Route::post('user/signin',array('as' => 'PostLogin', 'uses'=>'UserController@postSignin'));
});

Route::get('cart',array('as' => 'cart', 'uses'=>'CartController@index'));


*/

Route::group(array('before' => 'guest'), function(){
	Route::get('login',array('as' => 'login', 'uses'=>'UserController@index'));
	Route::get('daftar',array('as' => 'daftar', 'uses'=>'UserController@create'));
	

	Route::get('form',array('as'=>'form', 'uses'=>'MasterController@form'));

	Route::get('ajax',array('as'=>'ajax', 'uses'=>'SiteController@ajax'));
	Route::get('req',array('as'=>'req', 'uses'=>'SiteController@request'));
});

Route::group(array('before' => 'auth'), function() {
	Route::get('/',array('as'=>'index', 'uses'=>'SiteController@index'));
	Route::get('logout',array('as' => 'logout', 'uses'=> 'UserController@getLogout'));
	Route::resource('department', 'DepartmentController');
	Route::get('dataDepartment',array('as'=>'dataDept', 'uses'=>'dataTableController@department'));

	Route::resource('barang', 'BarangController');
	Route::get('dataBarang',array('as'=>'dataBrg', 'uses'=>'dataTableController@barang'));
	Route::get('dataBrg/{data}', 'dataTableController@getBarang');

	Route::resource('supplier', 'SupplierController');
	Route::get('dataSupplier',array('as'=>'dataSup', 'uses'=>'dataTableController@supplier'));


	Route::resource('STTB', 'STTBController');
	Route::get('dataSTTB',array('as'=>'dataSTTB', 'uses'=>'dataTableController@STTB'));
	Route::get('smpSTTB1/{data}', 'STTBController@simpan1');
	Route::get('smpSTTB2/{data}', 'STTBController@simpan2');
	Route::get('printSTTB/{id}',array('as'=>'printSTTB', 'uses'=>'ReportController@STTB'));

	Route::resource('SPPB', 'SPPBController');
	Route::get('dataSPPB',array('as'=>'dataSPPB', 'uses'=>'dataTableController@SPPB'));
	Route::get('smpSPPB1/{data}', 'SPPBController@simpan1');
	Route::get('smpSPPB2/{data}', 'SPPBController@simpan2');
	Route::get('printSPPB/{id}',array('as'=>'printSPPB', 'uses'=>'ReportController@SPPB'));

	
	Route::resource('PO', 'POController');
	Route::get('dataSPPBpo',array('as'=>'dataSPPBpo', 'uses'=>'dataTableController@SPPBpo'));
	Route::get('dataSPPB/{data}', 'dataTableController@getSPPB');
	Route::get('dataPOfull',array('as'=>'dataPOfull', 'uses'=>'dataTableController@POfull'));
	Route::get('printPO/{id}',array('as'=>'printPO', 'uses'=>'ReportController@PO'));

	Route::resource('invoice', 'InvoiceController');
	Route::get('dataPO',array('as'=>'dataPO', 'uses'=>'dataTableController@PO'));
	Route::get('dataPO/{data}', 'dataTableController@getPO');
	Route::get('dataInvfull',array('as'=>'dataInvfull', 'uses'=>'dataTableController@invfull'));
	Route::get('printInv/{id}',array('as'=>'printInv', 'uses'=>'ReportController@inv'));

	Route::resource('DO', 'DOController');
	Route::get('dataInv',array('as'=>'dataInv', 'uses'=>'dataTableController@inv'));
	Route::get('dataInv/{data}', 'dataTableController@getinv');
	Route::get('dataDO',array('as'=>'dataDO', 'uses'=>'dataTableController@DelO'));
	Route::get('printDO/{id}',array('as'=>'printDO', 'uses'=>'ReportController@DelO'));


	//report
	Route::get('lapRekap',array('as'=>'lapRekap', 'uses'=>'LaporanController@rekap'));
	Route::get('printRekap/{thn}',array('as'=>'printRekap', 'uses'=>'ReportController@rekap'));

	Route::get('lapInvo',array('as'=>'lapInvo', 'uses'=>'LaporanController@lapinvo'));
	Route::get('printInvo/{awal}/{akhir}',array('as'=>'printInvo', 'uses'=>'ReportController@lapinvo'));

	Route::get('lapSTTB',array('as'=>'lapSTTB', 'uses'=>'LaporanController@lapSTTB'));
	Route::get('printSTTB/{awal}/{akhir}',array('as'=>'printSTTB', 'uses'=>'ReportController@lapSTTB'));

	Route::get('lapSPPB',array('as'=>'lapSPPB', 'uses'=>'LaporanController@lapSPPB'));
	Route::get('printSPPB/{awal}/{akhir}',array('as'=>'printSPPB', 'uses'=>'ReportController@lapSPPB'));
});


Route::group(array('before' => 'csrf'), function(){
	Route::post('user/create',array('as' => 'PostCreate', 'uses'=>'UserController@postCreate'));
	Route::post('user/signin',array('as' => 'PostLogin', 'uses'=>'UserController@postSignin'));
});
