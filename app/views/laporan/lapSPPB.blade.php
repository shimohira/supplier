@extends('layouts.main')

@section('content')


<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Laporan Penjualan Barang
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> laporan Penjualan Barang
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
		{{Form::open(array('url'=>'','class'=>'form-horizontal', 'id'=> 'form-area'))}}

		<div class="form-group">
			{{form::label('awal', 'Awal', array('class' => 'col-sm-3 control-label'))}}
			<div class="col-sm-6">
				{{Form::text('awal', Input::old('awal') ,array('class'=>'form-control', 'id' => 'dateafter'))}}
			</div>
		</div>

		<div class="form-group">
			{{form::label('akhir', 'Akhir', array('class' => 'col-sm-3 control-label'))}}
			<div class="col-sm-6">
				{{Form::text('akhir', Input::old('akhir') ,array('class'=>'form-control', 'id' => 'datebefore'))}}
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<a class="btn btn-default" id="printRekap">Print</a>
			</div>
		</div>
		{{Form::close()}}
	</div>

	<script>
		$(document).ready(function(){

			$( "#dateafter" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});

			$( "#datebefore" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});

			$( "#printRekap" ).click(function() {
				var awal = document.getElementById("dateafter").value;
				var akhir = document.getElementById("datebefore").value;

				var w = window.open('printSPPB/'+awal+'/'+akhir, '_blank');
				w.focus();
			});

		});

	</script>
	
</div>
<!-- /.container-fluid -->

@stop