<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<title>LAPORAN PENDAPATAN TAHUNAN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<center>
		<img src="https://firebasestorage.googleapis.com/v0/b/kouvee-shop.appspot.com/o/header.png?alt=media&token=158f0502-39a7-4b08-af50-dcb0f5911922" alt="header" style="width:650px;height:150px;">
        <h5 class="font-weight-bold">LAPORAN PENDAPATAN TAHUNAN</h5>
	</center>
    <div class="container">
	<p align="left" class="font">Tahun : {{$tahun}}</p>
    </div>
	<table class='table table-bordered table-striped'>
		<thead class="thead-light">
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Bulan</th>
				<th class="text-center">Layanan</th>
				<th class="text-center">Produk</th>
				<th class="text-center">Total</th>
			</tr>
		</thead>
		<tbody>
				@php $i=1  @endphp
				@php $totalall=0 @endphp
				@foreach($dataL as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{\Carbon\Carbon::parse($p->bulanL)->translatedFormat('F')}}</td>
					<td> @currency($p->jumlahL * $p->hargaL),- </td>{{--Layanan--}}
					<td> </td>{{--Produk--}}
					<td> @currency($p->jumlahL * $p->hargaL ),- </td> {{--Layanan + Produk--}}
				</tr>
				{{$totalall += $p->jumlahL * $p->hargaL }} {{--get total tabel --}}
				@endforeach
		</tbody>
	</table>
	<div class="container">
        <p  class="font-weight-bold text-center">Total @currency($totalall),-</p>
        <p align="right">Dicetak tanggal {{$dt}}</p>
    </div>

</body>
</html>