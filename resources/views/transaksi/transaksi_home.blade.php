@extends('template');
@section('content')
<h1>Transaksi</h1>
<table>
    <tr>
        <th>#</th>
        <th>@sortablelink('tanggal', 'Tanggal')</th>
        <th>@sortablelink('kode', 'Kode')</th>
        <th>@sortablelink('deskripsi', 'Deskripsi')</th>
        <th>@sortablelink('kategori_nama', 'KATEGORI')</th>
        <th>@sortablelink('nilai', 'Nilai')</th>
        <th>@sortablelink('dompet_nama', 'Dompet')</th>
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
{!! $transaksis->appends(\Request::except('page'))->render() !!}
@endsection



