@extends('layouts.pdf')

@section('content')

@foreach($data as $key => $value)
<?php
$nm_supp =  $value->nm_supp;
$alamat = $value->alamat;
$telp = $value->telp;
$fax = $value->fax;
$ship_to = $value->ship_to;
$no_PO = $value->no_PO;
$tgl_PO = $value->tgl_PO;
$no_SPPB = $value->no_SPPB;
$no_DO = $value->no_DO;
?>
@endforeach

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


<h2>Delivery Order</h2>
<table style="width: 100%; text-align: left;" cellpadding="5" cellspacing="3" border="1">
	<tr>
		<td style="width: 30%">
			Supplier : {{$nm_supp}}
			<fieldset style="height: 100px">
				<table>
					<tr>
						<td colspan="3">
						{{$alamat}}
						</td>
					</tr>
					<tr>
						<td>
						Fax
						</td>
						<td>
						:
						</td>
						<td>
						{{$fax}}
						</td>
					</tr>
					<tr>
						<td>
						Telp
						</td>
						<td>
						:
						</td>
						<td>
						{{$telp}}
						</td>
					</tr>
				</table>
			</fieldset>
		</td>
		<td style="width: 30%">
			Penerima Barang : 
			<fieldset style="height: 100px">
				{{$ship_to}}
			</fieldset>
		</td>
		<td style="width: 40%" colspan="2">
			Signed on Behalf of PT.DYEI
			<table border="1" style="width: 100%; text-align: center;">
				<tr>
					<td style="width: 25%">Staff</td>
					<td style="width: 25%">KATIM</td>
					<td style="width: 25%">KADIV</td>
					<td style="width: 25%">PRESDIR</td>
				</tr>
				<tr>
					<td><br><br><br></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			No.PO : {{$no_PO}}
		</td>
		<td>
			Tanggal PO : {{$tgl_PO}}
		</td>
		<td>
			NO.SPPB : {{$no_SPPB}}
		</td>
		<td>
			NO.DO : {{$no_DO}}
		</td>
	</tr>
</table>

<table style="width: 100%; text-align: center;" cellpadding="5" cellspacing="3" border="5">
	<thead>
		<tr>
			<th style="width:8%;">no</th>
			<th>Part Number</th>
			<th>Part Name</th>
			<th style="width:8%;">unit</th>
			<th>QTY</th>
			<th>Price</th>
			<th>Amounts</th>
			<th>remark</th>
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
			$totalharga = $value->jml_pesan*$value->hrg_satuan;
			$totalQTY = $totalQTY+$value->jml_pesan;
			$totalhrgsat = $totalhrgsat+$value->hrg_satuan;
			$totalhrgseluruh = $totalhrgseluruh+$totalharga;
			$nama = $value->nama;
		?>
		<tr>
			<td>{{$counter}}</td>
			<td>{{ $value->kode_barang}}</td>
			<td>{{ $value->nm_barang }}</td>
			<td>{{ $value->satuan }}</td>
			<td>{{ $value->jml_pesan }}</td>
			<td>{{ $value->hrg_satuan }}</td>
			<td>{{ $totalharga}}</td>
			<td></td>
		</tr>
		<?php $counter++; ?>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" class="text-center">
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
			<td class="text-center">
				
			</td>
		</tr>
	</tfoot>
</table>
<br>
@stop