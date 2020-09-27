@extends('template');
@section('content')
<div class="title">
    <h1>Laporan Transaksi</h1>
</div>

<table>
    <tr>
        <th>#</th>
        <th>TANGGAL</th>
        <th>KODE</th>
        <th>DESKRIPSI</th>
        <th>KATEGORI</th>
        <th>NILAI</th>
        <th>DOMPET</th>
    </tr>
    @foreach ($data['transaksis'] as $key=> $item)
        <tr>
            <td>{{1+$key}}</td>
            <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')}}</td>
            <td>{{$item->kode}}</td>
            <td>{{$item->deskripsi}}</td>
            <td>{{$item->kategori_nama}}</td>
            <td>{{number_format($item->nilai, 2, ',', '.')}}</td>
            <td>{{$item->dompet_nama}}</td>
        </tr>
    @endforeach
</table>
<h1>SUMMARY</h1>
<p>MASUK : {{number_format($data['transaksisSum']['masuk'], 2, ',', '.')}}</p>
<p>KELUAR : {{number_format($data['transaksisSum']['keluar'], 2, ',', '.')}}</p>
<p>TOTAL : {{number_format($data['transaksisSum']['total'], 2, ',', '.')}}</p>
@endsection



