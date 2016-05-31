@extends('layouts.main')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				STTB
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> STTB
				</li>
			</ol>
		</div>
	</div>
	<!-- /.row -->
	{{ HTML::ul($errors->all()) }}
	@if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
    	{{Form::open(array('url'=>'STTB','class'=>'form-horizontal', 'id'=> 'form-area','name'=>'form-area'))}}
    	<div class="row">
    		<div class="col-xs-6">
    			<div class="form-group">
    				{{form::label('no_STTB', 'No.STTB', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('no_STTB', $noSTTB ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('tgl_STTB', 'Tanggal STTB', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('tgl_STTB', Input::old('tgl_STTB') ,array('class'=>'form-control', 'id' => 'datepicker'))}}
    				</div>
    			</div>

    		</div>
    		<div class="col-xs-5">
    			<div class="form-group">
    				{{form::label('dept', 'Supplier', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::select('id_supp', $supplier, Input::old('id_supp') ,array('class'=>'form-control', 'onchange' => 'jsFunction(this.value);', 'onmousedown' => "this.value='';"))}}
    				</div>
    			</div>		
    		</div>
    	</div>
    	<br>

    	<div class="row">
    		<div class="col-xs-6">
    			<div class="form-group">
    				{{form::label('kode_barang', 'Kode Barang', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('kode_barang', Input::old('kode_barang') ,array('class'=>'form-control','readonly'))}}
    				</div>
    				<a class="btn btn-default" id="cariBarang">Cari</a>
    			</div>
    			<div class="form-group">
    				{{form::label('nm_barang', 'Nama Barang', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('nm_barang', Input::old('nm_barang') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('satuan', 'Satuan Barang', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('satuan', Input::old('satuan') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>

    			<div class="form-group">
    				{{form::label('hrg_satuan', 'Harga Satuan', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('hrg_satuan', Input::old('hrg_satuan') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    		</div>

    		<div class="col-xs-5">
    			<div class="form-group">
    				{{form::label('jml_beli', 'Jumlah Beli', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('jml_beli', Input::old('jml_beli') ,array('class'=>'form-control'))}}
    				</div>
    			</div>

    			<div class="form-group">
    				{{form::label('brand', 'Brand', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('brand', Input::old('brand') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>

    			<div class="form-group">
    				{{form::label('ket', 'Keterangan', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    				{{Form::textarea('ket', Input::old('ket') ,array('class'=>'form-control', 'rows' => 3))}}
    				</div>
    			</div>
    			<div class="form-group">
    				<div class="col-sm-offset-4 col-sm-10">
    					<a class="btn btn-default" id="tambah">Tambah</a>
    					<a class="btn btn-default" id="hapus">Hapus</a>
    				</div>
    			</div>
    		</div>
    		
    	</div>

		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<a class="btn btn-default" id="simjs">Simpan</a>
				<a class="btn btn-default" id="printSTTB">Print</a>
				{{Form::reset('batal', array("class"=>"btn btn-default"))}}
			</div>
		</div>
		
	</div>

	<div class="row">
		<div id='error'></div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<table id="detilBrg" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-left">Kode Barang</th>
						<th class="text-left">Nama Barang</th>
						<th class="text-left">Harga Satuan</th>
						<th class="text-left">Jumlah Beli</th>
						<th class="text-left">Keterangan</th>
						<th class="text-left">Jumlah harga</th>
					</tr>
				</thead>

				<tbody>
				</tbody>

				<tfoot>
					<tr>
						<th class="text-left">Kode Barang</th>
						<th class="text-left">Nama Barang</th>
						<th class="text-left">Harga Satuan</th>
						<th class="text-left">Jumlah Beli</th>
						<th class="text-left">Keterangan</th>
						<th class="text-left">Jumlah harga</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	{{Form::close()}}

	<div id="barang" title="tabel barang" style="width:1000px;">
		<table class="display" id="dataBrg">
			<thead>
				<tr>
					<th class="text-left">Kode Barang</th>
					<th class="text-left">Nama Barang</th>
					<th class="text-left">Satuan</th>
					<th class="text-left">Harga Satuan</th>
					<th class="text-left">Jumlah Barang</th>

				</tr>
			</thead>

			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<th class="text-left">Kode Barang</th>
					<th class="text-left">Nama Barang</th>
					<th class="text-left">Satuan</th>
					<th class="text-left">Harga Satuan</th>
					<th class="text-left">Jumlah Barang</th>

				</tr>
			</tfoot>
		</table>
	</div>

	<div id="dialog-confirm"></div>

	<div id="STTB" title="tabel STTB" style="width:1000px;">
		<table class="display" id="dataSTTB">
			<thead>
				<tr>
					<th class="text-left">No STTB</th>
					<th class="text-left">Tanggal STTB</th>
					<th class="text-left">Supplier</th>
				</tr>
			</thead>

			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<th class="text-left">No STTB</th>
					<th class="text-left">Tanggal STTB</th>
					<th class="text-left">Supplier</th>

				</tr>
			</tfoot>
		</table>
	</div>

	<script>

		var acx = 'SP001';
		function jsFunction(value) {
			acx = value;
		}
		$(document).ready(function(){
			var formArea = $('#form-area');

			$( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy/mm/dd'
			});

			//tambah barang
			var detilbrg = $('#detilBrg').DataTable({
				"paging":   false,
				"sDom": 'rt<"clear">',
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','kode_barang');
		                $('td', row).eq(3).attr('id','jml_beli');
		                $('td', row).eq(4).attr('id','ket');
		        }
			});

			
			$('#detilBrg tbody').on( 'click', 'tr', function () {
				var kd_brg = $(this).find("#kode_barang").html(); 
				var jml_beli = $(this).find("#jml_beli").html();
				var ket = $(this).find("#ket").html();
				
	            $.ajax({
					url: 'dataBrg/{id}',
	                type: 'GET',
	                data: { id: kd_brg },
	                success: function(response)
	                {
	                	formArea.find('#kode_barang').val(response['kode_barang']);
						formArea.find('#nm_barang').val(response['nm_barang']);
						formArea.find('#satuan').val(response['satuan']);
						formArea.find('#brand').val(response['brand']);
						formArea.find('#hrg_satuan').val(response['hrg_satuan']);
						formArea.find('#jml_beli').val(jml_beli);
						formArea.find('#ket').val(ket);
	                }
				});
			} );

	
			$( "#tambah" ).on( 'click', function () {
				if (document.getElementById("kode_barang").value != '') {
					if (document.getElementById("jml_beli").value != '') {
						var hrg_satuan = document.getElementById("hrg_satuan").value;
						var jml_beli = document.getElementById("jml_beli").value;
						detilbrg.row.add( [
							document.getElementById("kode_barang").value,
							document.getElementById("nm_barang").value,
							hrg_satuan,
							jml_beli,
							document.getElementById("ket").value,
							hrg_satuan*jml_beli
							] ).draw();
						formArea.find('#kode_barang').val('');
						formArea.find('#nm_barang').val('');
						formArea.find('#satuan').val('');
						formArea.find('#hrg_satuan').val('');
						formArea.find('#brand').val('');
						formArea.find('#jml_beli').val('');
						formArea.find('#ket').val('');
					} else {
						alert('isi jumlah pesan sebelum tambah')
						//document.getElementById('error').innerHTML = 'isi jumlah pesan sebelum tambah';
					}
				} else {
					alert('cari barang sebelum tambah')
					//document.getElementById('error').innerHTML = 'cari barang sebelum tambah';
				}
			});

			$('#detilBrg tbody').on( 'click', 'tr', function () {
				if ( $(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					detilbrg.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
			} );

			$( "#hapus" ).on( 'click', function () {
				detilbrg.row('.selected').remove().draw( false );
			});
			
			//cari barang
			$('#dataBrg').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataBrg')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','kode_barang');
		                $('td', row).eq(1).attr('id','nm_barang');
		        },

		        "columnDefs": [ 
		        	{ //this prevents errors if the data is null
			            "targets": "_all",
			            "defaultContent": ""
		        	}
		        ],
			} );

			
			$('#dataBrg tbody').on( 'click', 'tr', function () {
				var kd_brg = $(this).find("#kode_barang").html(); 
				var nm_brg = $(this).find("#nm_barang").html();
	            $.ajax({
					url: 'dataBrg/{data}',
	                type: 'GET',
	                data: { id: kd_brg, nm : nm_brg },
	                success: function(response)
	                {
	                	formArea.find('#kode_barang').val(response['kode_barang']);
						formArea.find('#nm_barang').val(response['nm_barang']);
						formArea.find('#satuan').val(response['satuan']);
						formArea.find('#brand').val(response['brand']);
						formArea.find('#hrg_satuan').val(response['hrg_satuan']);
						formArea.find('#jml_beli').val('');
						formArea.find('#ket').val('');
	                 	barang.dialog( "close" );   
	                }
				});
			} );


			barang = $( "#barang" ).dialog({
				autoOpen: false,
				width: 800,
				show: {
					effect: "blind",
					duration: 500
				},
				hide: {
					effect: "explode",
					duration: 300
				}
			});

			$( "#cariBarang" ).click(function() {
				barang.dialog( "open" );
			});

			//simpan STTB
			var dtlBrg = $('#detilBrg tbody');


			$("#simjs").on( 'click', function () {
				var y = document.forms["form-area"]["tgl_STTB"].value;
			    if (y == null || y == "") {
			        alert("Tanggal STTB harus di isi terlebih dahulu");
			        return false;
			    } else {
					fnOpenNormalDialog();
				}
			});

			// Cari STTB
			$('#dataSTTB').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataSTTB')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','no_STTB');
		        },

		        "columnDefs": [ 
		        	{ //this prevents errors if the data is null
			            "targets": "_all",
			            "defaultContent": ""
		        	}
		        ],
			} );

			
			$('#dataSTTB tbody').on( 'click', 'tr', function () {
				var no_STTB = $(this).find("#no_STTB").html(); 
				STTB.dialog( "close" );

				var w = window.open('printSTTB/'+no_STTB, '_blank');
  				w.focus();
			} );

			STTB = $( "#STTB" ).dialog({
				autoOpen: false,
				width: 600,
				show: {
					effect: "blind",
					duration: 500
				},
				hide: {
					effect: "explode",
					duration: 300
				}
			});

			$( "#printSTTB" ).click(function() {
				STTB.dialog( "open" );
			});

		});


		function fnOpenNormalDialog() {
			$("#dialog-confirm").html("Yakin akan di simpan");

		    // Define the Dialog and its properties.
		    $("#dialog-confirm").dialog({
		    	resizable: false,
		    	modal: true,
		    	title: "Modal",
		    	height: 250,
		    	width: 400,
		    	buttons: {
		    		"Yes": function () {
		    			$(this).dialog('close');
		    			simpan();
		    		},
		    		"No": function () {
		    			$(this).dialog('close');
		    			alert("tidak jadi di simpan");
		    		}
		    	}
		    });
		}

		function simpan() {
			var no_STTB = document.getElementById("no_STTB").value;
			var tgl_STTB = document.getElementById("datepicker").value;
			var x = document.getElementById("detilBrg").rows.length;
			var z = document.getElementById("detilBrg").rows[1].innerHTML;
			var y = document.getElementById("detilBrg").rows[1].cells;
			
			//alert(tgl_STTB);
			
			
			if (y[0].innerHTML == 'No data available in table') {				
				alert('isi barang terlebih dahulu');
			} else {
				$.ajax({
					url: 'smpSTTB1/{data}',
					type: 'GET',
					async: false,
					cache: false,
					data: { idSupp : acx, noSTTB : no_STTB, tglSTTB : tgl_STTB},
					success: function(response)
					{
						for (var i=0;i<x-2;i++) {
							var row = document.getElementById("detilBrg").rows[i+1].cells;
							if (i==x-1) {
								alert('success simpan');
							}
							$.ajax({
								url: 'smpSTTB2/{data}',
								type: 'GET',
								async: false,
								cache: false,
								data: {noSTTB : no_STTB,kd_brg : row[0].innerHTML, jml_beli: row[3].innerHTML, ket: row[4].innerHTML},
								success: function(response)
								{
									console.log('success');
								}
							});
						}
					}
				});
				window.location.replace("STTB");	
			}
		}

	</script>
	
</div>
<!-- /.container-fluid -->

@stop