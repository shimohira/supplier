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
	</li>
	<li>
		Messrs. PT ITD GEMILANG
		<br>
		<br>
		Attn. Mrs. Idol Fauzi
	</li>
	<li>
		TAHUN : {{$id}}
		<br>
		<br>
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
			<th>Jumlah Barang Masuk</th>
			<th>Jumlah Barang Keluar</th>
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
		$totPesan = $totPesan+$value->total_pesan;
		$totBeli = $totBeli+$value->total_beli;
		?>
		<tr>
			<td>{{$counter}}</td>
			<td>{{ $value->kode_barang}}</td>
			<td>{{ $value->nm_barang }}</td>
			<td>{{ $value->satuan }}</td>
			<td>{{ $value->jml_barang }}</td>
			<td>{{ $value->total_pesan }}</td>
			<td>{{ $value->total_beli }}</td>
		</tr>
		<?php $counter++; ?>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" class="text-center">
				Total Seluruh
			</td>
			<td class="text-center">
				
			</td>
			<td class="text-center">
				{{$totPesan}}
			</td>
			<td class="text-center">
				{{$totBeli}}
			</td>
		</tr>
	</tfoot>
</table>

<br>
@stop