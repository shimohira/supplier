@extends('layouts.pdf')

@section('content')


<style type="text/css">
	.header {
		width:700px;
	}
	h2 {
		text-align: center;
	}

	ul {
		width: 950px;
		padding: 0;
		list-style-type: none;
	}

	li {
		display: inline-block;
		width: 25%;
	}
	
</style>


<h2>Laporan Pengadaan Barang</h2>
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
			<th>Nama Penerima</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Jumlah Barang</th>
			<th>Brand</th>
		</tr>
	</thead>
	<?php 
		$counter=1;
		?>
	<tbody>
		@foreach($data as $key => $value)
		<tr>
			<td>{{$counter}}</td>
			<td>{{ $value->nm_supp}}</td>
			<td>{{ $value->kode_barang }}</td>
			<td>{{ $value->nm_barang }}</td>
			<td>{{ $value->total_beli }}</td>
			<td>{{ $value->brand }}</td>
		</tr>
		<?php $counter++; ?>
		@endforeach
	</tbody>
</table>
<br><br>
<table style="width:100%; text-align:center;">
	<tr>
		<td width="30%;"></td>
		<td></td>
		<td></td>
		<td></td>
		<td width="30%;">Tangerang, Date</td>
	</tr>
	<tr>
		<td><br><br></td>
		<td></td>
		<td></td>
		<td></td>
		<td><br><br></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><hr width="100%;"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Direktur</td>
	</tr>
</table>

<br>
@stop