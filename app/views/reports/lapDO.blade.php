@extends('layouts.pdf')

@section('content')

<style type="text/css">
	.header {
		width:1024px;
	}
	h2 {
		text-align: center;
	}

	ul {
		width: 1397px;
		padding: 0;
		list-style-type: none;
	}

	li {
		display: inline-block;
		width: 25%;
	}
	
</style>


<h2>Laporan Pengiriman Barang</h2>
<ul>

	<li>
		Messrs. PT ITD GEMILANG
		<br>
		<br>
		Attn. Mrs. Ido Fauzi
	</li>
	<li>
		Tanggal awal : {{$awal}}
		<br>
		<br>
		Karyawan : {{Auth::user()->nama}}
	</li>
	<li>
		Tanggal akhir : {{$akhir}}
	</li>
</ul>

<table style="width: 100%; text-align: center;" cellpadding="5" cellspacing="3" border="5">
	<thead>
		<tr>
			<th style="width:8%;">no</th>
			<th>Nama Supplier</th>
			<th>Alamat</th>
			<th style="width:8%;">Telephone</th>
			<th>Pelabuhan</th>
			<th>Carrier</th>
			<th>Tanggal Pengiriman</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$counter=1;
		?>
		@foreach($data as $key => $value)
		<tr>
			<td>{{$counter}}</td>
			<td>{{ $value->nm_supp}}</td>
			<td>{{ $value->alamat }}</td>
			<td>{{ $value->telp }}</td>
			<td>{{ $value->pelabuhan }}</td>
			<td>{{ $value->carrier }}</td>
			<td>{{ $value->tgl_DO }}</td>
		</tr>
		<?php $counter++; ?>
		@endforeach
	</tbody>
</table>
<br>
@stop