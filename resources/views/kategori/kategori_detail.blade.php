@extends('template');
@section('content')
<h1>Detail Kategori</h1>
<table>
    <tr>
        <th>#</th>
        <th>NAMA</th>
        <th>DESKRIPSI</th>
        <th>STATUS</th>
    </tr>
    <tr>
        <td>1</td>
        <td>{{$kategori->nama}}</td>
        <td>{{$kategori->deskripsi}}</td>
        <td>
            @if ($kategori->isactive==1)Aktif
            @else Tidak Aktif
            @endif
        </td>
    </tr>
</table>
@endsection



