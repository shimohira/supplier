@extends('layouts.main')

@section('content')


<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Rekapitulasi Barang
			</h1>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-dashboard"></i>  <a href="{{URL::route('index')}}">Dashboard</a>
				</li>
				<li class="active">
					<i class="fa fa-edit"></i> Rekapitulasi Barang
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
			{{form::label('tahun', 'Tahun', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-5">
				<select name="yearpicker" id="yearpicker" class="form-control" onchange='jsFunction(this.value);', onmousedown = "this.value='';"></select>
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
		var acx = new Date().getFullYear();

		function jsFunction(value) {
			acx = value;
			console.log(acx);
		}

		$(document).ready(function(){
			for (i = new Date().getFullYear(); i > 2000; i--)
			{
				$('#yearpicker').append($('<option />').val(i).html(i));
			}

			$( "#printRekap" ).click(function() {
				var year = acx; 

				var w = window.open('printRekap/'+acx, '_blank');
  				w.focus();
			});

		});

	</script>
	
</div>
<!-- /.container-fluid -->

@stop