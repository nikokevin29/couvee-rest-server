<!DOCTYPE html>
<html>
<head>
	<title>NOTA LUNAS</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<img src="https://firebasestorage.googleapis.com/v0/b/kouvee-shop.appspot.com/o/header.png?alt=media&token=158f0502-39a7-4b08-af50-dcb0f5911922" alt="header" style="width:650px;height:150px;">
        <h5>NOTA LUNAS</h5>
	</center>
    <div class="container">
        <p align="right">{{$header->tanggaltransaksi}}</p>
        <p align="left">{{$header->noLY}}</p>
		<p align="left">Member :{{$header->getcustomer->nama}}({{$header->gethewan->nama}})</p> 
		<p align="left">Telpon : {{$header->getcustomer->notelp}}</p>
		<p align="right">CS : {{$header->getpegawai->nama}}</p>
    </div>
    <div style="border-top:1px solid black; border-bottom:1px solid black; margin-top:2%;" class="text m-2">
		<div class="container text-center m-4 font-weight-bold">Layanan</div>
    </div>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Nama Layanan</th>
				<th class="text-center">Harga</th>
				<th class="text-center">jumlah</th>
				<th class="text-center">Subtotal</th>
			</tr>
		</thead>
		<tbody>
				@php $i=1 @endphp
				@foreach($detil as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$p->getlayanan->nama}}</td>
					<td>{{$p->getlayanan->harga}}</td>
					<td>{{$p->jumlah}}</td>
					<td>{{$p->subtotal}}</td>
				</tr>
				@endforeach
			</tbody>
	</table>
	<div class="container">
        <p align="right">Subtotal : {{$sum}}</p>
        <p align="right">Diskon :{{ $header->diskon}}</p>
        <p align="right" class="font-weight-bold">Total :{{ $header->total}}</p>
    </div>

</body>
</html>