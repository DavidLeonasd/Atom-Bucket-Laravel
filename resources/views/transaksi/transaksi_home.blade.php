@extends('template');
@section('content')
<h1>Transaksi</h1>
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
    @foreach ($transaksis as $key=>$item)
        <tr>
            <td>{{$transaksis->firstItem()+$key}}</td>
            <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')}}</td>
            <td>{{$item->kode}}</td>
            <td>{{$item->deskripsi}}</td>
            <td>{{$item->kategori_nama}}</td>
            <td>{{$item->nilai}}</td>
            <td>{{$item->dompet_nama}}</td>
        </tr>
    @endforeach
</table>
{{ $transaksis->links() }}
@endsection



