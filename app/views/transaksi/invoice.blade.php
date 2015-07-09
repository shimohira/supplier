@extends('layouts.main')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Invoice
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> Invoice
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
    	{{Form::open(array('url'=>'invoice','class'=>'form-horizontal', 'id'=> 'form-area', "onsubmit"=>"return validateForm()", 'name'=>'form-area'))}}
    	<div class="row">
    		<div class="col-xs-6">
    			<div class="form-group">
    				{{form::label('no_inv', 'No.Invoice', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('no_inv', $noINV ,array('class'=>'form-control','readonly'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('tgl_inv', 'Tanggal Invoice', array('class' => 'col-sm-3 control-label'))}}
    				<div class="col-sm-6">
    					{{Form::text('tgl_inv', Input::old('tgl_inv') ,array('class'=>'form-control', 'id' => 'datepicker'))}}
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
    				<div class="col-sm-offset-4 col-sm-10">
    					<a class="btn btn-default" id="cariPO">Cari PO</a>
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
    				{{Form::textarea('ship_by', Input::old('ship_by') ,array('class'=>'form-control','rows' => 3))}}
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
    				{{form::label('pay_method', 'Payment Method', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('pay_method', Input::old('pay_method') ,array('class'=>'form-control'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('no_rek', 'No.Rekening', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('no_rek', Input::old('no_rek') ,array('class'=>'form-control'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('pelabuhan', 'Pelabuhan', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('pelabuhan', Input::old('pelabuhan') ,array('class'=>'form-control'))}}
    				</div>
    			</div>
    			<div class="form-group">
    				{{form::label('carrier', 'Carrier', array('class' => 'col-sm-4 control-label'))}}
    				<div class="col-sm-7">
    					{{Form::text('carrier', Input::old('carrier') ,array('class'=>'form-control'))}}
    				</div>
    			</div>
    		</div>
    	</div>

		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{Form::submit('Simpan', array("class"=>"btn btn-default", "onclick "=>"return confirm('yakin untuk input');"))}}
				<a class="btn btn-default" id="printInv">Print</a>
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

	<div id="PO" title="tabel PO" style="width:1000px;">
		<table class="display" id="dataPO">
			<thead>
				<tr>
					<th class="text-left">No PO</th>
					<th class="text-left">Tanggal PO</th>
					<th class="text-left">Department</th>
				</tr>
			</thead>

			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<th class="text-left">No PO</th>
					<th class="text-left">Tanggal PO</th>
					<th class="text-left">Department</th>

				</tr>
			</tfoot>
		</table>
	</div>

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

			// Cari PO
			$('#dataPO').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataPO')}}",
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
				detilbrg.clear().draw();
				var no_PO = $(this).find("#no_PO").html(); 
				PO.dialog( "close" );
				formArea.find('#no_PO').val(no_PO);
				
	            $.ajax({
					url: 'dataPO/{data}',
	                type: 'GET',
	                data: { id: no_PO},
	                success: function(response)
	                {
	                	//formArea.find('#no_PO').val(response['no_PO']);

	                	//formArea.find('#id_dept').val(response['id_dept']);
	                	for (var i=0;i<response.length;i++){
	                		console.log(response);
	                		formArea.find('#ship_to').val(response[i]['ship_to']);
	                		addrow(response[i]['kode_barang'],response[i]['nm_barang'],response[i]['hrg_satuan'],response[i]['jml_pesan'],response[i]['ket'],response[i]['hrg_satuan']*response[i]['jml_pesan']);
	                	}
	                }
				});
			} );

			PO = $( "#PO" ).dialog({
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

			$( "#cariPO" ).click(function() {
				PO.dialog( "open" );
			});

			//print invo
			$('#dataINV').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataInvfull')}}",
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
				var no_inv = $(this).find("#no_inv").html();
				invoice.dialog( "close" );

				var w = window.open('printInv/'+no_inv, '_blank');
  				w.focus();
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

			$( "#printInv" ).click(function() {
				invoice.dialog( "open" );
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
			var z = document.forms["form-area"]["no_PO"].value;
		    if (z == null || z == "") {
		        alert("No.PO harus di cari terlebih dahulu");
		        return false;
		    }

			var w = document.forms["form-area"]["tgl_invoice"].value;
		    if (w == null || w == "") {
		        alert("Tanggal Invoice harus di cari terlebih dahulu");
		        return false;
		    }

		    var y = document.forms["form-area"]["pay_method"].value;
		    if (y == null || y == "") {
		        alert("Payment Method harus di isi terlebih dahulu");
		        return false;
		    }

		    var x = document.forms["form-area"]["ship_by"].value;
		    if (x == null || x == "") {
		        alert("Penerima Barang harus di isi terlebih dahulu ");
		        return false;
		    }

		    var a = document.forms["form-area"]["pelabuhan"].value;
		    if (a == null || a == "") {
		        alert("Pelabuhan harus di isi terlebih dahulu");
		        return false;
		    }

		    var b = document.forms["form-area"]["carrier"].value;
		    if (b == null || b == "") {
		        alert("Carrier harus di isi terlebih dahulu");
		        return false;
		    }

		    var c = document.forms["form-area"]["no_rek"].value;
		    if (c == null || c == "") {
		        alert("No.Rekenin harus di isi terlebih dahulu");
		        return false;
		    }

		    
		}

	</script>
	
</div>
<!-- /.container-fluid -->

@stop