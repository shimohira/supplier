@extends('layouts.main')

@section('content')


<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Supplier
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> Supplier
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
		{{Form::open(array('url'=>'supplier','class'=>'form-horizontal', 'id'=> 'form-area'))}}

		<div class="form-group">
			{{form::label('id_supp', 'ID Supplier', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{Form::text('id_supp', $id_supp ,array('class'=>'form-control','readonly'))}}
			</div>
		</div>

		<div class="form-group">
			{{form::label('nm_supp', 'Nama Supplier', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{Form::text('nm_supp', Input::old('nm_supp') ,array('class'=>'form-control'))}}
			</div>
		</div>
		<div class="form-group">
			{{form::label('alamat', 'Alamat', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{Form::textarea('alamat', Input::old('alamat') ,array('class'=>'form-control', 'rows' => 3))}}
			</div>
		</div>

		<div class="form-group">
			{{form::label('telp', 'Nomor Telepon', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{Form::text('telp', Input::old('telp') ,array('class'=>'form-control'))}}
			</div>
		</div>

		<div class="form-group">
			{{form::label('fax', 'Nomor Fax', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{Form::text('fax', Input::old('fax') ,array('class'=>'form-control'))}}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{Form::submit('Simpan', array("class"=>"btn btn-default"))}}
				{{Form::reset('batal', array("class"=>"btn btn-default"))}}
			</div>
		</div>
		{{Form::close()}}
	</div>

	<div class="row">
		<div class="col-lg-12">
			<table class="display" id="dataSupp">
				<thead>
					<tr>
						<th class="text-left">ID Supplier</th>
						<th class="text-left">Nama Supplier</th>
						<th class="text-left">Alamat</th>
						<th class="text-left">No.Telepon</th>
						<th class="text-left">No.Fax</th>
						<th class="text-left">action</th>
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
						<th class="text-left">action</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>



	<script>

		$(document).ready(function(){

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
		        	}, {
		        		"width": "15%", "targets": 5
		        	}, {
		        		"width": "11%", "targets": 0
		        	}, {
		        		"width": "13%", "targets": 1
		        	}, {
		        		"width": "10%", "targets": 4
		        	}, {
		        		"width": "10%", "targets": 3
		        	}
		        ],
		        "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    $('td:eq(5)', nRow).html('<form method="POST" action="{{URL::route("supplier.index")}}/'+aData[0]+'" accept-charset="UTF-8" style="width:0px; height:35px;"><input name="_token" type="hidden" value="tgKkJihckoXj2ngZ2ruXuhp5bZsu9XG58SlQA660"> <input name="_method" type="hidden" value="DELETE"><input type="submit" class="btn btn-warning" value="Delete Supplier"></form>');
                    return nRow; },
			} );

			var formArea = $('#form-area');

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
				//$("#form-area").attr("action", "/");
			} );

		});

	</script>
	
</div>
<!-- /.container-fluid -->

@stop