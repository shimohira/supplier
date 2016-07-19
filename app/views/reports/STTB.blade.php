@extends('layouts.pdf')

@section('content')

@foreach($data as $key => $value)
<?php
$nama = $value->nama;
?>
@endforeach
<style type="text/css">
	.page-break {
    	page-break-after: always;
	}
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


<h2>Surat Tanda Terima Barang</h2>

<ul>
	<li>
		Messrs. PT ITD GEMILANG
		<br>
		<br>
		Attn. Mrs. Ido Fauzi
	</li>
	<li>
		No.STTB : {{$id}}
		<br>
		<br>
		Karyawan : {{$nama}}
	</li>
</ul>
<table style="width: 100%; text-align: center;" cellpadding="5" cellspacing="3" border="5">
	<thead>
		<tr>
			<th style="width:8%;">no</th>
			<th>Kode barang</th>
			<th>Nama Barang</th>
			<th>Part Number</th>
			<th>Brand</th>
			<th>satuan</th>
			<th>QTY</th>
			<th>U/Price</th>
			<th>Amounts</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$counter=1; 
		$totalQTY = 0;
		$totalhrgsat = 0;
		$totalhrgseluruh = 0;
		?>
		@foreach($data as $key => $value)
		<?php
			$totalharga = $value->jml_beli*$value->hrg_satuan;
			$totalQTY = $totalQTY+$value->jml_beli;
			$totalhrgsat = $totalhrgsat+$value->hrg_satuan;
			$totalhrgseluruh = $totalhrgseluruh+$totalharga;
			$nama = $value->nama;
		?>
		<tr>
			<td>{{$counter}}</td>
			<td>{{ $value->kode_barang}}</td>
			<td>{{ $value->nm_barang }}</td>
			<td>{{ $value->part_number}}</td>
			<td>{{ $value->brand }}</td>
			<td>{{ $value->satuan}}</td>
			<td>{{ $value->jml_beli }}</td>
			<td>{{ $value->hrg_satuan }}</td>
			<td>{{ $totalharga}}</td>
		</tr>
		<?php $counter++; ?>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="6" class="text-center">
				Total
			</td>
			<td class="text-center">
				{{$totalQTY}}
			</td>
			<td class="text-center">
				{{$totalhrgsat}}
			</td>
			<td class="text-center">
				{{$totalhrgseluruh}}
			</td>
		</tr>
	</tfoot>
</table>
<br>
<table style="width:100%; text-align:center;">
	<tr>
		<td width="30%;">Confirmed and Accepted By,</td>
		<td></td>
		<td></td>
		<td></td>
		<td width="30%;">On or Behalf of</td>
	</tr>
	<tr>
		<td><br><br></td>
		<td></td>
		<td></td>
		<td></td>
		<td><br><br></td>
	</tr>
	<tr>
		<td><hr width="100%;"></td>
		<td></td>
		<td></td>
		<td></td>
		<td><hr width="100%;"></td>
	</tr>
	<tr>
		<td>ITD Enterprises Co.,Ltd.</td>
		<td></td>
		<td></td>
		<td></td>
		<td>ITD Gemilang Indonesia</td>
	</tr>
</table>


@stop