@extends('layouts.main')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				SPPB
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> SPPB
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
    	{{Form::open(array('url'=>'SPPB','class'=>'form-horizontal', 'id'=> 'form-area','name'=>'form-area'))}}
    	<div class="row">
    		<div class="col-xs-6">
    			<div class="form-group">
    				{{form::label('no_SPPB', 'No.SPPB', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('no_SPPB', $noSPPB ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('tgl_SPPB', 'Tanggal SPPB', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('tgl_SPPB', Input::old('tgl_SPPB') ,array('class'=>'form-control', 'id' => 'datepicker'))}}
    				</div>
    			</div>

    		</div>
    		<div class="col-xs-5">
    			<div class="form-group">
    				{{form::label('dept', 'Department', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::select('id_dept', $department, Input::old('id_dept') ,array('class'=>'form-control', 'onchange' => 'jsFunction(this.value);', 'onmousedown' => "this.value='';"))}}
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
    				{{form::label('jml_pesan', 'Jumlah Pesan', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('jml_pesan', Input::old('jml_pesan') ,array('class'=>'form-control'))}}
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
				<a class="btn btn-default" id="printSPPB">Print</a>
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
						<th class="text-left">Jumlah Pesan</th>
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
						<th class="text-left">Jumlah Pesan</th>
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

	<div id="SPPB" title="tabel SPPB" style="width:1000px;">
		<table class="display" id="dataSPPB">
			<thead>
				<tr>
					<th class="text-left">No SPPB</th>
					<th class="text-left">Tanggal SPPB</th>
					<th class="text-left">Department</th>
				</tr>
			</thead>

			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<th class="text-left">No SPPB</th>
					<th class="text-left">Tanggal SPPB</th>
					<th class="text-left">Department</th>

				</tr>
			</tfoot>
		</table>
	</div>

	<script>

		var acx = 'DP001';
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
		                $('td', row).eq(3).attr('id','jml_pesan');
		                $('td', row).eq(4).attr('id','ket');
		        }
			});

			
			$('#detilBrg tbody').on( 'click', 'tr', function () {
				var kd_brg = $(this).find("#kode_barang").html(); 
				var jml_pesan = $(this).find("#jml_pesan").html();
				var ket = $(this).find("#ket").html();
				
	            $.ajax({
					url: 'dataBrg/{id}',
	                type: 'GET',
	                data: { id: kd_brg },
	                dataType: 'json',
	                success: function(response)
	                {
	                	formArea.find('#kode_barang').val(response['kode_barang']);
						formArea.find('#nm_barang').val(response['nm_barang']);
						formArea.find('#satuan').val(response['satuan']);
						formArea.find('#brand').val(response['brand']);
						formArea.find('#hrg_satuan').val(response['hrg_satuan']);
						formArea.find('#jml_pesan').val(jml_pesan);
						formArea.find('#ket').val(ket);
	                }
				});
			} );

	
			$( "#tambah" ).on( 'click', function () {
				if (document.getElementById("kode_barang").value != '') {
					if (document.getElementById("jml_pesan").value != '') {
						var hrg_satuan = document.getElementById("hrg_satuan").value;
						var jml_pesan = document.getElementById("jml_pesan").value;
						detilbrg.row.add( [
							document.getElementById("kode_barang").value,
							document.getElementById("nm_barang").value,
							hrg_satuan,
							jml_pesan,
							document.getElementById("ket").value,
							hrg_satuan*jml_pesan
							] ).draw();
						formArea.find('#kode_barang').val('');
						formArea.find('#nm_barang').val('');
						formArea.find('#satuan').val('');
						formArea.find('#hrg_satuan').val('');
						formArea.find('#brand').val('');
						formArea.find('#jml_pesan').val('');
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
						formArea.find('#jml_pesan').val('');
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

			//simpan SPPB
			var dtlBrg = $('#detilBrg tbody');


			$("#simjs").on( 'click', function () {
				var y = document.forms["form-area"]["tgl_SPPB"].value;
			    if (y == null || y == "") {
			        alert("Tanggal SPPB harus di isi terlebih dahulu");
			        return false;
			    } else {
					fnOpenNormalDialog();
				}
			});

			// Print SPPB
			$('#dataSPPB').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataSPPB')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','no_SPPB');
		        },

		        "columnDefs": [ 
		        	{ //this prevents errors if the data is null
			            "targets": "_all",
			            "defaultContent": ""
		        	}
		        ],
			} );

			
			$('#dataSPPB tbody').on( 'click', 'tr', function () {
				var no_SPPB = $(this).find("#no_SPPB").html(); 
				SPPB.dialog( "close" );

				var w = window.open('printSPPB/'+no_SPPB, '_blank');
  				w.focus();
			} );

			SPPB = $( "#SPPB" ).dialog({
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

			$( "#printSPPB" ).click(function() {
				SPPB.dialog( "open" );
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
			var no_SPPB = document.getElementById("no_SPPB").value;
			var tgl_SPPB = document.getElementById("datepicker").value;
			var x = document.getElementById("detilBrg").rows.length;
			var z = document.getElementById("detilBrg").rows[1].innerHTML;
			var y = document.getElementById("detilBrg").rows[1].cells;
			
			//alert(tgl_SPPB);
			
			
			if (y[0].innerHTML == 'No data available in table') {				
				alert('isi barang terlebih dahulu');
			} else {
				$.ajax({
					url: 'smpSPPB1/{data}',
					type: 'GET',
					data: { idDept : acx, noSPPB : no_SPPB, tglSPPB : tgl_SPPB},
					success: function(response)
					{
						console.log('success');
					}
				});
				for (var i=0;i<x-2;i++) {
					var row = document.getElementById("detilBrg").rows[i+1].cells;
					if (i==x-1) {
						alert('success simpan');
					}
					$.ajax({
						url: 'smpSPPB2/{data}',
						type: 'GET',
						data: {noSPPB : no_SPPB,kd_brg : row[0].innerHTML, jml_pesan: row[3].innerHTML, ket: row[4].innerHTML},
						success: function(response)
						{
							console.log('success');
						}
					});
				}
				window.location.replace("SPPB");	
			}
		}

	</script>
	
</div>
<!-- /.container-fluid -->

@stop
