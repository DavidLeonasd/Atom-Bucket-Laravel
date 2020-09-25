@extends('template');
@section('content')
    content dompet
<table>
    <tr>
        <th>#</th>
        <th>NAMA</th>
        <th>REFERENSI</th>
        <th>DESKRIPSI</th>
        <th>STATUS</th>
    </tr>
    <tr>
        <td>1</td>
        <td>{{$dompet->nama}}</td>
        <td>{{$dompet->referensi}}</td>
        <td>{{$dompet->deskripsi}}</td>
        <td>
            @if ($dompet->isactive==1)Aktif
            @else Tidak Aktif
            @endif
        </td>
    </tr>
</table>
@endsection



