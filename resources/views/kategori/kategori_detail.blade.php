@extends('template');
@section('content')
<div class="title">
    <h1>Kategori Detail</h1>
</div>
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



