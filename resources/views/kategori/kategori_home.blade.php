@extends('template');
@section('content')
<table>
    <tr>
        <th>#</th>
        <th>@sortablelink('nama', 'Nama')</th>
        <th>@sortablelink('deskripsi', 'Deskripsi')</th>
        <th>@sortablelink('isactive', 'Status')</th>
        <th>ACTIONS</th>
    </tr>
    @foreach ($kategoris as $key=>$item)
        <tr>
            <td>{{$kategoris->firstItem()+$key}}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->deskripsi}}</td>
            <td>
                @if ($item->isactive==1)Aktif
                @else Tidak Aktif
                @endif
            </td>
            <td><a href="/kategori/{{$item->id}}">Detail</a><br>
            <a href="/kategori/{{$item->id}}/edit">Ubah</a><br>
                @if ($item->isactive!=1)<a href="/kategori/{{$item->id}}/changestatus/1">Aktif</a>
                @else <a href="/kategori/{{$item->id}}/changestatus/0">Tidak Aktif</a>
                @endif
            </td>
        </tr>
    @endforeach
</table>
{!! $kategoris->appends(\Request::except('page'))->render() !!}
@endsection



