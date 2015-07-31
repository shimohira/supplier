@extends('layouts.main')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Purches Order
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> PO
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
    	{{Form::open(array('url'=>'PO','class'=>'form-horizontal', 'id'=> 'form-area', "onsubmit"=>"return validateForm()", 'name'=>'form-area'))}}
    	<div class="row">
    		<div class="col-xs-6">
    			<div class="form-group">
    				{{form::label('id_supp', 'ID Supplier', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('id_supp', Input::old('id_supp') ,array('class'=>'form-control','readonly'))}}
    				</div>
    				<a class="btn btn-default" id="cariSupplier">Cari</a>
    			</div>
    			<div class="form-group">
    				{{form::label('nm_supp', 'Nama Supplier', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('nm_supp', Input::old('nm_supp') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('telp', 'Nomor Telepon', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('telp', Input::old('telp') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('fax', 'Nomor Fax', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('fax', Input::old('fax') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    		</div>

    		<div class="col-xs-5">
    			<div class="form-group">
    				{{form::label('alamat', 'Alamat', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    				{{Form::textarea('alamat', Input::old('alamat') ,array('class'=>'form-control', 'readonly' ,'rows' => 3))}}
    				</div>
    			</div>

    			<div class="form-group">
    				{{form::label('ship_to', 'Penerima Barang', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    				{{Form::textarea('ship_to', Input::old('ship_to') ,array('class'=>'form-control', 'rows' => 3))}}
    				</div>
    			</div>
    		</div>
    	</div>

    	<br>
    	<div class="row">
    		<div class="col-xs-6">
    			<div class="form-group">
    				{{form::label('no_PO', 'No.PO', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('no_PO', $noPO ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('tgl_PO', 'Tanggal PO', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('tgl_PO', Input::old('tgl_PO') ,array('class'=>'form-control', 'id' => 'datepicker'))}}
    				</div>
    			</div>
    		</div>
    		
    		<div class="col-xs-5">
    			<div class="form-group">
    				{{form::label('city', 'Kota Tujuan', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('city', Input::old('city') ,array('class'=>'form-control'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('no_SPPB', 'No.SPPB', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('no_SPPB', Input::old('no_SPPB') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				<div class="col-sm-offset-4 col-sm-10">
    					<a class="btn btn-default" id="cariSPPB">Cari SPPB</a>
    				</div>
    			</div>		
    		</div>
    	</div>

		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{Form::submit('Simpan', array("class"=>"btn btn-default", "onclick "=>"return confirm('yakin untuk input');"))}}
				<a class="btn btn-default" id="printPO">Print</a>
				{{Form::reset('batal', array("class"=>"btn btn-default","onclick "=>"clearrow()"))}}
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

	<div id="supplier" title="tabel supplier" style="width:1000px;">
		<table class="display" id="dataSupp">
			<thead>
				<tr>
					<th class="text-left">ID Supplier</th>
					<th class="text-left">Nama Supplier</th>
					<th class="text-left">Alamat</th>
					<th class="text-left">No.Telepon</th>
					<th class="text-left">No.Fax</th>
				</tr>
			</thead>
			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<th class="text-left">ID Supplier</th>
					<th class="text-left">Nama Supplier</th>
					<th class="text-left">Alamat</th>
					<th class="text-left">No.Telepon</th>
					<th class="text-left">No.Fax</th>
				</tr>
			</tfoot>
		</table>
	</div>

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

	<div id="PO" title="tabel PO" style="width:1000px;">
		<table class="display" id="dataPO">
			<thead>
				<tr>
					<th class="text-left">No PO</th>
					<th class="text-left">Tanggal PO</th>
					<th class="text-left">Nama Supplier</th>
				</tr>
			</thead>

			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<th class="text-left">No PO</th>
					<th class="text-left">Tanggal PO</th>
					<th class="text-left">Nama Supplier</th>

				</tr>
			</tfoot>
		</table>
	</div>

	<script>
		var detilbrg = $('#detilBrg').DataTable({
				"paging":   false,
				"sDom": 'rt<"clear">',
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','kode_barang');
		                $('td', row).eq(3).attr('id','jml_pesan');
		                $('td', row).eq(4).attr('id','ket');
		        }
			});

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

			
			$('#detilBrg tbody').on( 'click', 'tr', function () {
				var kd_brg = $(this).find("#kode_barang").html(); 
				var jml_pesan = $(this).find("#jml_pesan").html();
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
						formArea.find('#jml_pesan').val(jml_pesan);
						formArea.find('#ket').val(ket);
	                }
				});
			} );
			
			//cari supplier
			$('#dataSupp').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataSup')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','id_supp');
		                $('td', row).eq(1).attr('id','nm_supp');
		                $('td', row).eq(2).attr('id','alamat');
		                $('td', row).eq(3).attr('id','telp');
		                $('td', row).eq(4).attr('id','fax');
		        },

		        "columnDefs": [ 
		        	{ //this prevents errors if the data is null
			            "targets": "_all",
			            "defaultContent": ""
		        	}
		        ],
			} );

			
			$('#dataSupp tbody').on( 'click', 'tr', function () {
				var id_supp = $(this).find("#id_supp").html(); 
				var nm_supp = $(this).find("#nm_supp").html();
				var satuan = $(this).find("#alamat").html(); 
				var hrg_satuan = $(this).find("#telp").html(); 
				var jml_barang = $(this).find("#fax").html(); 
				formArea.find('#id_supp').val(id_supp);
				formArea.find('#nm_supp').val(nm_supp);
				formArea.find('#alamat').val(satuan);
				formArea.find('#telp').val(hrg_satuan);
				formArea.find('#fax').val(jml_barang);
				supplier.dialog( "close" );
			} );


			supplier = $( "#supplier" ).dialog({
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

			$( "#cariSupplier" ).click(function() {
				supplier.dialog( "open" );
			});

			// Cari SPPB
			$('#dataSPPB').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataSPPBpo')}}",
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
				clearrow();
				var no_SPPB = $(this).find("#no_SPPB").html(); 
				SPPB.dialog( "close" );
				formArea.find('#no_SPPB').val(no_SPPB);
				
	            $.ajax({
					url: 'dataSPPB/{data}',
	                type: 'GET',
	                data: { id: no_SPPB},
	                success: function(response)
	                {
	                	//formArea.find('#no_SPPB').val(response['no_SPPB']);

	                	//formArea.find('#id_dept').val(response['id_dept']);
	                	for (var i=0;i<response.length;i++){
	                		console.log(response);	
	                		addrow(response[i]['kode_barang'],response[i]['nm_barang'],response[i]['hrg_satuan'],response[i]['jml_pesan'],response[i]['ket'],response[i]['hrg_satuan']*response[i]['jml_pesan']);
	                	}
	                }
				});
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

			$( "#cariSPPB" ).click(function() {
				SPPB.dialog( "open" );
			});

			//print PO
			$('#dataPO').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataPOfull')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','no_PO');
		        },

		        "columnDefs": [ 
		        	{ //this prevents errors if the data is null
			            "targets": "_all",
			            "defaultContent": ""
		        	}
		        ],
			} );

			$('#dataPO tbody').on( 'click', 'tr', function () {
				var no_PO = $(this).find("#no_PO").html(); 
				PO.dialog( "close" );

				var w = window.open('printPO/'+no_PO, '_blank');
  				w.focus();
			} );


			PO = $( "#PO" ).dialog({
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

			$( "#printPO" ).click(function() {
				PO.dialog( "open" );
			});

		});


		function addrow(a, b, c, d, e, f) {
			detilbrg.row.add( [
				a,
				b,
				c,
				d,
				e,
				f
				] ).draw();
		}
		function clearrow() {
			detilbrg.clear().draw();
		}


		function validateForm() {
			var w = document.forms["form-area"]["id_supp"].value;
		    if (w == null || w == "") {
		        alert("ID Supplier harus di cari terlebih dahulu");
		        return false;
		    }
		    var x = document.forms["form-area"]["ship_to"].value;
		    if (x == null || x == "") {
		        alert("Ship To harus di isi terlebih dahulu ");
		        return false;
		    }

		    var y = document.forms["form-area"]["tgl_PO"].value;
		    if (y == null || y == "") {
		        alert("Tanggal PO harus di isi terlebih dahulu");
		        return false;
		    }

		    var z = document.forms["form-area"]["no_SPPB"].value;
		    if (z == null || z == "") {
		        alert("No.SPPB harus di cari terlebih dahulu");
		        return false;
		    }
		}

	</script>
	
</div>
<!-- /.container-fluid -->

@stop