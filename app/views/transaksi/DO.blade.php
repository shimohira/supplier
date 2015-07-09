@extends('layouts.main')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Delivery Order
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> Delivery Order
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
    	{{Form::open(array('url'=>'DO','class'=>'form-horizontal', 'id'=> 'form-area', "onsubmit"=>"return validateForm()", 'name'=>'form-area'))}}
    	<div class="row">
    		<div class="col-xs-6">
    			<div class="form-group">
    				{{form::label('no_DO', 'No.DO', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('no_DO', $noDO ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('tgl_DO', 'Tanggal DO', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('tgl_DO', Input::old('tgl_DO') ,array('class'=>'form-control', 'id' => 'datepicker'))}}
    				</div>
    			</div>
    		</div>

    		<div class="col-xs-5">
    			<div class="form-group">
    				{{form::label('no_PO', 'No.PO', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('no_PO', Input::old('no_PO') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>

    			<div class="form-group">
    				{{form::label('no_inv', 'No.Invoice', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('no_inv', Input::old('no_inv') ,array('class'=>'form-control', 'readonly'))}}
    				</div>
    			</div>
    			
    			<div class="form-group">
    				<div class="col-sm-offset-4 col-sm-10">
    					<a class="btn btn-default" id="cariINV">Cari Invoice</a>
    				</div>
    			</div>

    			
    		</div>
    	</div>

    	<br>
    	<div class="row">
    		<div class="col-xs-6">
    			<div class="form-group">
    				{{form::label('ship_by', 'Pengirim Barang', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    				{{Form::textarea('ship_by', Input::old('ship_by') ,array('class'=>'form-control','readonly','rows' => 3))}}
    				</div>
    			</div>

    			<div class="form-group">
    				{{form::label('ship_to', 'Penerima Barang', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    				{{Form::textarea('ship_to', Input::old('ship_to') ,array('class'=>'form-control', 'readonly', 'rows' => 3))}}
    				</div>
    			</div>
    		</div>
    		
    		<div class="col-xs-5">
    			<div class="form-group">
    				{{form::label('nm_supp', 'Supplier', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('nm_supp', Input::old('nm_supp') ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('alamat', 'Alamat', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    				{{Form::textarea('alamat', Input::old('alamat') ,array('class'=>'form-control', 'readonly', 'rows' => 3))}}
    				</div>
    			</div>
    		</div>
    	</div>

		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{Form::submit('Simpan', array("class"=>"btn btn-default", "onclick "=>"return confirm('yakin untuk input');"))}}
				<a class="btn btn-default" id="printDO">Print</a>
				{{Form::reset('batal', array("class"=>"btn btn-default", "onclick "=>"clearrow()"))}}
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

	<div id="invoice" title="tabel Invoice" style="width:1000px;">
		<table class="display" id="dataINV">
			<thead>
				<tr>
					<th class="text-left">No.Invoice</th>
					<th class="text-left">Tanggal Invoice</th>
					<th class="text-left">NO.PO</th>
					<th class="text-left">Tanggal PO</th>
					<th class="text-left">Nama Supplier</th>
				</tr>
			</thead>

			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<th class="text-left">No.Invoice</th>
					<th class="text-left">Tanggal Invoice</th>
					<th class="text-left">NO.PO</th>
					<th class="text-left">Tanggal PO</th>
					<th class="text-left">Nama Supplier</th>

				</tr>
			</tfoot>
		</table>
	</div>

	<div id="DO" title="tabel DO" style="width:1000px;">
		<table class="display" id="dataDO">
			<thead>
				<tr>
					<th class="text-left">No.DO</th>
					<th class="text-left">Tanggal DO</th>
					<th class="text-left">no.Invoice</th>
					<th class="text-left">No.PO</th>
				</tr>
			</thead>

			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<th class="text-left">No.DO</th>
					<th class="text-left">Tanggal DO</th>
					<th class="text-left">no.Invoice</th>
					<th class="text-left">No.PO</th>
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

			// Cari inv
			$('#dataINV').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataInv')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','no_inv');
		        },

		        "columnDefs": [ 
		        	{ //this prevents errors if the data is null
			            "targets": "_all",
			            "defaultContent": ""
		        	}
		        ],
			} );


			
			$('#dataINV tbody').on( 'click', 'tr', function () {
				detilbrg.clear().draw();
				var no_inv = $(this).find("#no_inv").html(); 
				invoice.dialog( "close" );
				formArea.find('#no_inv').val(no_inv);
				
	            $.ajax({
					url: 'dataInv/{data}',
	                type: 'GET',
	                data: { id: no_inv},
	                success: function(response)
	                {
	                	//formArea.find('#no_PO').val(response['no_PO']);

	                	//formArea.find('#id_dept').val(response['id_dept']);
	                	for (var i=0;i<response.length;i++){
	                		console.log(response);
	                		formArea.find('#no_PO').val(response[i]['no_PO']);
	                		formArea.find('#ship_to').val(response[i]['ship_to']);
	                		formArea.find('#ship_by').val(response[i]['ship_by']);
	                		formArea.find('#nm_supp').val(response[i]['nm_supp']);
	                		formArea.find('#alamat').val(response[i]['alamat']);
	                		addrow(response[i]['kode_barang'],response[i]['nm_barang'],response[i]['hrg_satuan'],response[i]['jml_pesan'],response[i]['ket'],response[i]['hrg_satuan']*response[i]['jml_pesan']);
	                	}
	                }
				});
			} );

			invoice = $( "#invoice" ).dialog({
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

			$( "#cariINV" ).click(function() {
				invoice.dialog( "open" );
			});

			//print DO
			$('#dataDO').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataDO')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','no_DO');
		        },

		        "columnDefs": [ 
		        	{ //this prevents errors if the data is null
			            "targets": "_all",
			            "defaultContent": ""
		        	}
		        ],
			} );

			$('#dataDO tbody').on( 'click', 'tr', function () {
				var no_DO = $(this).find("#no_DO").html(); 
				DO.dialog( "close" );

				var w = window.open('printDO/'+no_DO, '_blank');
  				w.focus();
			} );


			DO = $( "#DO" ).dialog({
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

			$( "#printDO" ).click(function() {
				DO.dialog( "open" );
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

		var formArea = $('#form-area');

		function validateForm() {
			var z = document.forms["form-area"]["no_inv"].value;
		    if (z == null || z == "") {
		        alert("No.Invoice harus di cari terlebih dahulu");
		        return false;
		    }

			var w = document.forms["form-area"]["tgl_DO"].value;
		    if (w == null || w == "") {
		        alert("Tanggal DO harus di isi terlebih dahulu");
		        return false;
		    }
		    
		}

	</script>
	
</div>
<!-- /.container-fluid -->

@stop