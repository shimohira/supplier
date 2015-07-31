@extends('layouts.main')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Dashboard <small>Statistics Overview</small>
			</h1>
			<ol class="breadcrumb">
				<li class="active">
					<i class="fa fa-dashboard"></i> Dashboard
				</li>
			</ol>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-exclamation fa-fw"></i> Barang</h3>
				</div>
				<div class="panel-body">
					<div class="text-left">
						<p>Daftar Stock Barang dibawah 10</p>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>
									Kode Barang
								</th>
								<th>
									Nama Barang
								</th>
								<th>
									satuan
								</th>
								<th>
									Stock Barang
								</th>
							</thead>
							<tbody>
								@foreach($barang as $key => $value)
								<tr>
									<td>{{ $value->kode_barang}}</td>
									<td>{{ $value->nm_barang}}</td>
									<td>{{ $value->satuan}}</td>
									<td>{{ $value->jml_barang}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="text-right">
						<a href="{{ URL::route('barang.index')}}">View Details <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Daftar User</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>
									Nomor Karyawan
								</th>
								<th>
									Nama Karyawan
								</th>
								<th>
									Username
								</th>
								<th>
									Level
								</th>
							</thead>
							<tbody>
								@foreach($user as $key => $value)
								<tr>
									<td>{{ $value->no_kar}}</td>
									<td>{{ $value->nama}}</td>
									<td>{{ $value->username}}</td>
									<td>{{ $value->level}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="text-right">
						<a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->


</div>
<!-- /.container-fluid -->


@stop