@extends('layouts.main')

@section('content')


<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Department
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> Department
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
		{{Form::open(array('url'=>'department','class'=>'form-horizontal', 'id'=> 'form-area'))}}

		<div class="form-group">
			{{form::label('id_dept', 'ID Department', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{Form::text('id_dept', $id_dept ,array('class'=>'form-control','readonly'))}}
			</div>
		</div>

		<div class="form-group">
			{{form::label('nm_dept', 'Nama Department', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				{{Form::text('nm_dept', Input::old('nm_dept') ,array('class'=>'form-control'))}}
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
			<table class="display" id="dataDept">
				<thead>
					<tr>
						<th class="text-left">ID Department</th>
						<th class="text-left">Nama Department</th>
						<th class="text-left">action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>

				<tfoot>
					<tr>
						<th class="text-left">ID Department</th>
						<th class="text-left">Nama Department</th>
						<th class="text-left">action</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>



	<script>

		$(document).ready(function(){

			$('#dataDept').DataTable( {
				"processing": true,
        		"serverSide": true,
				"sAjaxSource": "{{URL::route('dataDept')}}",
				"aaSorting": [[ 0, "asc" ]],
				"createdRow": function ( row, data, index ) {
		                $('td', row).eq(0).attr('id','id_dept');
		                $('td', row).eq(1).attr('id','nm_dept');
		        },
		        "columnDefs": [ { //this prevents errors if the data is null
		            "targets": "_all",
		            "defaultContent": ""
		        } ],
		        "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    $('td:eq(2)', nRow).html('<form method="POST" action="{{URL::route("department.index")}}/'+aData[0]+'" accept-charset="UTF-8" style="width:0px; height:35px;"><input name="_token" type="hidden" value="tgKkJihckoXj2ngZ2ruXuhp5bZsu9XG58SlQA660"> <input name="_method" type="hidden" value="DELETE"><input type="submit" class="btn btn-warning" value="Delete Department"></form>');
                    return nRow; },
			} );

			var table = $('#dataDept').DataTable();
			var formArea = $('#form-area');

			$('#dataDept tbody').on( 'click', 'tr', function () {
				var id_dept = $(this).find("#id_dept").html(); 
				var nm_dept = $(this).find("#nm_dept").html();
				formArea.find('#id_dept').val(id_dept);
				formArea.find('#nm_dept').val(nm_dept);
				//$("#form-area").attr("action", "/");
			} );

		});

	</script>
	
</div>
<!-- /.container-fluid -->

@stop