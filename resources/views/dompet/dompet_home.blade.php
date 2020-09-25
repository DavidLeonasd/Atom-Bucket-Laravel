@extends('template');
@section('content')
    content dompet
<table>
    <tr>
        <th>#</th>
        <th><a href='?asd=1'>NAMA</a></th>
        <th>REFERENSI</th>
        <th>DESKRIPSI</th>
        <th>STATUS</th>
        <th>ACTIONS</th>
    </tr>
    @foreach ($dompets as $key=>$item)
        <tr>
            <td>{{$dompets->firstItem()+$key}}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->referensi}}</td>
            <td>{{$item->deskripsi}}</td>
            <td>
                @if ($item->isactive==1)Aktif
                @else Tidak Aktif
                @endif
            </td>
            <td><a href="/dompet/{{$item->id}}">Detail</a><br>
            <a href="/dompet/{{$item->id}}/edit">Ubah</a><br>
                @if ($item->isactive!=1)<a href="/dompet/{{$item->id}}/changestatus/1">Aktif</a>
                @else <a href="/dompet/{{$item->id}}/changestatus/0">Tidak Aktif</a>
                @endif
            </td>
        </tr>
    @endforeach
</table>
{{ $dompets->links() }}
@endsection



