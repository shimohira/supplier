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


<h2>Laporan Pembayaran Barang</h2>
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
			<th>Nama Department</th>
			<th>No.SPPB</th>
			<th>Tgl.SPPB</th>
			<th>No.PO</th>
			<th>Tgl.PO</th>
			<th>Pembayaran</th>
			<th>Tgl. Pembayaran</th>
			<th>Metode Pembayaran</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$counter=1;
		?>
		@foreach($data as $key => $value)
		<tr>
			<td>{{$counter}}</td>
			<td>{{ $value->nm_dept }}</td>
			<td>{{ $value->no_SPPB }}</td>
			<td>{{ $value->tgl_SPPB }}</td>
			<td>{{ $value->no_PO }}</td>
			<td>{{ $value->tgl_PO }}</td>
			<td>{{ ($value->no_inv!=null)?"sudah dibayar":"belum dibayar" }}</td>
			<td>{{ ($value->tgl_inv!=null)?$value->tgl_inv:"-" }}</td>
			<td>{{ ($value->pay_method!=null)?$value->pay_method:"-" }}</td>
		</tr>
		<?php $counter++; ?>
		@endforeach
	</tbody>
</table>
<br>
@stop