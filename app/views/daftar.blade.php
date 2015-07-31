@extends('layouts.main')

@section('content')


<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Users
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> Users
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
		{{Form::open(array('url'=>'user/create','class'=>'form-horizontal', 'id'=> 'form-area'))}}

		<div class="form-group">
			{{form::label('nama', 'Nama', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{ Form::text('nama', Input::old('nama'), array('class'=>'form-control', 'placeholder'=>'Nama')) }}
			</div>
		</div>
		<div class="form-group">
			{{form::label('no_kar', 'Nomor Karyawan', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{ Form::text('no_kar', Input::old('no_kar'), array('class'=>'form-control', 'placeholder'=>'Nomor Karyawan')) }}	
			</div>
		</div>
		<div class="form-group">
			{{form::label('username', 'Username', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder'=>'Username')) }}
			</div>
		</div>
		<div class="form-group">
			{{form::label('level', 'Level', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{Form::select('level', array('admin'=>'admin','user'=>'user'), Input::old('level') ,array('class'=>'form-control'))}}
			</div>
		</div>
		<div class="form-group">
			{{form::label('password', 'Password', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Input Password')) }}
			</div>
		</div>
		<div class="form-group">
			{{form::label('password_confirmation', 'Confirm Password', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{Form::submit('Register', array('class'=>'btn btn-default'))}}
				{{Form::reset('batal', array("class"=>"btn btn-default"))}}
			</div>
		</div>
		{{Form::close()}}
	</div>
	<!-- /.row -->

	<div id="something" align="center">



	<script>

		$(document).ready(function(){

			$('#dataBrg').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataBrg')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','kode_barang');
		        },

		        "columnDefs": [ 
		        	{ //this prevents errors if the data is null
			            "targets": "_all",
			            "defaultContent": ""
		        	}, {
		        		"width": "15%", "targets": 5
		        	}
		        ],
		        "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    $('td:eq(5)', nRow).html('<form method="POST" action="{{URL::route("barang.index")}}/'+aData[0]+'" accept-charset="UTF-8" style="width:0px; height:35px;"><input name="_token" type="hidden" value="tgKkJihckoXj2ngZ2ruXuhp5bZsu9XG58SlQA660"> <input name="_method" type="hidden" value="DELETE"><input type="submit" class="btn btn-warning" value="Delete Barang"></form>');
                    return nRow; },
			} );

			var formArea = $('#form-area');


			$('#dataBrg tbody').on( 'click', 'tr', function () {

				var kd_brg = $(this).find("#kode_barang").html(); 

				$.ajax({
					url: 'dataBrg/{id}',
	                type: 'GET',
	                data: { id: kd_brg },
	                success: function(response)
	                {
	                	formArea.find('#kode_barang').val(response['kode_barang']);
						formArea.find('#nm_barang').val(response['nm_barang']);
						formArea.find('#part_number').val(response['part_number']);
						formArea.find('#satuan').val(response['satuan']);
						formArea.find('#brand').val(response['brand']);
						formArea.find('#hrg_satuan').val(response['hrg_satuan']);
						formArea.find('#jml_barang').val(response['jml_barang']);
	                    
	                }
				});
				
				
				//$("#form-area").attr("action", "/");
			} );

		});

	</script>
	
</div>
<!-- /.container-fluid -->

@stop