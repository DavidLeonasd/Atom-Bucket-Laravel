@extends('template');
@section('content')
<div class='content-top'>
    <div class="content-top-left">
        <h1>{{$params['isMasuk']==1?'Dompet Masuk':'Dompet Keluar'}}</h1>
    </div>
    <div class='content-top-right'>
        <button onclick="redirectToCreate()">Buat Baru</button>
    </div>
</div>
<div class='content-feature-group'>
    <div class='content-feature-group-left'>
        <input type="number" id="rowPerPage-Input" onblur="refreshWithFilter()" placeholder=10 value={{$params['requestQueryString']['rowPerPage']}}>
        <label for="page-content-count-input">/Halaman</label>
    </div>
    <div class='content-feature-group-right'>
        <label for="filterword-Input">Filter</label>
        <input type="text" id="filterword-Input" onblur="refreshWithFilter()" placeholder="Filter Keyword.." value={{$params['requestQueryString']['filterWordInput']}}>
    </div>
</div>
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
    @foreach ($params['transaksis'] as $key=>$item)
        <tr>
            <td>{{$params['transaksis']->firstItem()+$key}}</td>
            <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')}}</td>
            <td>{{$item->kode}}</td>
            <td>{{$item->deskripsi}}</td>
            <td>{{$item->kategori_nama}}</td>
            <td>{{number_format($item->nilai,2,',','.')}}</td>
            <td>{{$item->dompet_nama}}</td>
        </tr>
    @endforeach
</table>
{!! $params['transaksis']->appends(\Request::except('page'))->render() !!}
@endsection


@section('script')
<script>
    
    function refreshWithFilter(){
        var filterWordInput=document.getElementById("filterword-Input").value;
        var rowPerPage=document.getElementById("rowPerPage-Input").value;

        window.location.href = window.location.href.split('?')[0]+"?filterword="+filterWordInput+"&rowperpage="+rowPerPage;
    }
    function redirectToCreate(){
        window.location.href = window.location.href.split('?')[0]+"/create";
    }
</script>
@endsection
