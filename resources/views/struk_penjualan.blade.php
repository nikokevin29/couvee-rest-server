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
        <p class="text-right">{{$header->noPR}}</p>
        <p class="text-left">PR-200120-99</p>
    </div>
    <div class="container">
        <p class="text-left">Member : </p>
        <p class="text-left">Telpon : </p>
        <p class="text-left">CS :</p>
    </div>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>jumlah</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<!-- <tbody>
			@php $i=1 @endphp
			@foreach($transaksi_penjualan as $p)
			<tr>
				<td></td>{{ $i++ }}</td>
				<td>{{$p->nama}}</td>
				<td>{{$p->harga}}</td>
				<td>{{$p->jumlah}}</td>
				<td>{{$p->subtotal}}</td>
			</tr>
			@endforeach
		</tbody> -->
	</table>
 
</body>
</html>