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
		width: 1100px;
		padding: 0;
		list-style-type: none;
	}

	li {
		display: inline-block;
		width: 25%;
	}
	
</style>


<h2>Rekapitulasi Barang</h2>
<ul>
	<li>
		Messrs. PT ITD GEMILANG
		<br>
		<br>
		Attn. Mrs. Idol Fauzi
	</li>
	<li>
		Karyawan : {{Auth::user()->nama}}
	</li>
</ul>

<table style="width: 100%; text-align: center;" cellpadding="5" cellspacing="3" border="5">
	<thead>
		<tr>
			<th style="width:8%;">no</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th style="width:8%;">satuan</th>
			<th style="width:8%;">Jumlah Barang</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$counter=1;
		$totPesan = 0;
		$totBeli = 0;
		?>
		@foreach($data as $key => $value)
		<?php
		if ($value->pesan==null) {
			$value->pesan = 0;
		} if ($value->beli==null) {
			$value->beli = 0;
		}
		$totPesan = $totPesan+$value->pesan;
		$totBeli = $totBeli+$value->beli;
		?>
		<tr>
			<td>{{$counter }}</td>
			<td>{{ $value->kode_barang }}</td>
			<td>{{ $value->nm_barang }}</td>
			<td>{{ $value->satuan }}</td>
			<td>{{ $value->jml_barang}}</td>
		</tr>
		<?php $counter++; ?>
		@endforeach
	</tbody>
</table>

<br>
@stop