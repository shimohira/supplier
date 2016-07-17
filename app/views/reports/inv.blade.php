@extends('layouts.pdf')

@section('content')
    @foreach($data as $key => $value)
        <?php
        $tgl_po = $value->tgl_PO ;
        $ship_by = $value->ship_by ;
        $ship_to = $value->ship_to;
        $payment = $value->pay_method;
        $no_rek = $value->no_rek;
        $pelabuhan = $value->pelabuhan;
        $carrier = $value->carrier;
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
        table.data td
        {
            padding: 0 7px 0 7px;
        }

    </style>


    <h2>Invoice</h2>

    <table class="data" style="width: 100%;">
        <tr>
            <td colspan="3" style="text-align: center; padding-bottom: 10px">
                Tgl Invoice : {{ $tgl_po }}
            </td>
        </tr>
        <tr>
            <td valign="top" width="33%">
                Shipper / Exporter :
                <table style="border: 1px solid black; margin-top: 1px; width: 100%; height: 90px">
                    <tr>
                        <td valign="top">{{ $ship_by }}</td>
                    </tr>
                </table>
            </td>
            <td valign="top" width="33%">
                for :
                <table style="border: 1px solid black; margin-top: 1px; width: 100%; height: 90px">
                    <tr>
                        <td valign="top">{{ $ship_to }}</td>
                    </tr>
                </table>
            </td>
            <td valign="top" width="33%" style="padding-top: 13px">
                <table>
                    <tr>
                        <td>Payment Method</td>
                        <td>:</td>
                        <td>{{$payment}}</td>
                    </tr>
                    <tr>
                        <td>No Rekening</td>
                        <td>:</td>
                        <td>{{$no_rek}}</td>
                    </tr>
                    <tr>
                        <td>Pelabuhan</td>
                        <td>:</td>
                        <td>{{$pelabuhan}}</td>
                    </tr>
                    <tr>
                        <td>Carrier</td>
                        <td>:</td>
                        <td>{{$carrier}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%; text-align: center;" cellpadding="5" cellspacing="3" border="5">
        <thead>
        <tr>
            <th style="width:8%;">no</th>
            <th>Nama Barang</th>
            <th>Kode barang</th>
            <th>Part Number</th>
            <th>Total Qty</th>
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
            $totalharga = $value->jml_pesan*$value->hrg_satuan;
            ?>
            <tr>
                <td>{{$counter}}</td>
                <td>{{ $value->nm_barang }}</td>
                <td>{{ $value->kode_barang}}</td>
                <td>{{ $value->part_number}}</td>
                <td>{{ $value->jml_pesan}}</td>
                <td>{{ $value->hrg_satuan }}</td>
                <td>{{ $totalharga }}</td>
            </tr>
            <?php $counter++; ?>
        @endforeach
        </tbody>
    </table>
    <br>
    <table style="width:100%; text-align:center;">
        <tr>
            <td width="30%;">On or Behalf of</td>
            <td></td>
            <td></td>
            <td></td>
            <td width="30%;"></td>
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
            <td></td>
        </tr>
        <tr>
            <td>ITD Gemilang Indonesia</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

        </tr>
    </table>


@stop