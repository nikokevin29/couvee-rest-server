<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<title>SURAT PEMESANAN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<center>
		<img src="https://firebasestorage.googleapis.com/v0/b/kouvee-shop.appspot.com/o/header.png?alt=media&token=158f0502-39a7-4b08-af50-dcb0f5911922" alt="header" style="width:650px;height:150px;">
        <h5 class="font-weight-bold">SURAT PEMESANAN</h5>
	</center>
    <div class="container">
        <p align="right" class="font-weight-bold">No. {{$header->noPO}}</p>
        <p align="right" class="font-weight-bold">Tanggal :{{$header->tglpesan}}</p>
    </div>
    <div style="border:1px dashed #000000; padding:15px; display: inline-block;">
		<p align="left">{{$header->getsupplier->nama}}</p> 
		<p align="left">{{$header->getsupplier->alamat}}</p>
		<p align="left">{{$header->getsupplier->notelp}}</p>
    </div>
    <div style=" margin-top:2%;">
		<div class="text-left">Mohon untuk disediakan produk-produk berikut ini :</div>
    </div>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Nama Produk</th>
				<th class="text-center">Satuan</th>
				<th class="text-center">jumlah</th>
			</tr>
		</thead>
		<tbody>
				@php $i=1 @endphp
				@foreach($detil as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$p->getproduk->nama}}</td>
					<td>{{$p->satuan}}</td>
					<td>{{$p->jumlah}}</td>
				</tr>
				@endforeach
			</tbody>
	</table>
	<div class="container">
        <p align="right">Dicetak tanggal {{ $header->tglcetak}}</p>
    </div>

</body>
</html>