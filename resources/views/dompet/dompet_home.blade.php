@extends('template');
@section('content')
<div class='content-top'>
    <div class="content-top-left">
        <h1>Dompet</h1>
    </div>
    <div class='content-top-right'>
        <button onclick="redirectToCreate()">Buat Baru</button>
        <select id="isactive-filter-select" onchange="refreshWithFilter()">
            <option id="isactive-filter-select-option" value=1>Aktif</option>
            <option id="isactive-filter-select-option" value=0>Tidak Aktif</option>
        </select>
    </div>
</div>
<div class='content-feature-group'>
    <div class='content-feature-group-left'>
        <input type="number" id="rowPerPage-Input" onblur="refreshWithFilter()" placeholder="Filter Keyword.." value={{$params['requestQueryString']['rowPerPage']}}>
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
        <th>@sortablelink('nama', 'Nama')</th>
        <th>@sortablelink('referensi', 'Referensi')</th>
        <th>@sortablelink('deskripsi', 'Deskripsi')</th>
        <th>@sortablelink('isactive', 'Status')</th>
        <th>ACTIONS</th>
    </tr>
    @foreach ($params['dompets'] as $key=>$item)
        <tr>
            <td>{{$params['dompets']->firstItem()+$key}}</td>
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
{!! $params['dompets']->appends(\Request::except('page'))->render() !!}
@endsection


@section('script')
<script>
    
    function refreshWithFilter(){
        var filterWordInput=document.getElementById("filterword-Input").value;
        var filterIsActiveValue=document.getElementById("isactive-filter-select").value;
        var rowPerPage=document.getElementById("rowPerPage-Input").value;

        window.location.href = window.location.href.split('?')[0]+"?filterword="+filterWordInput+"&filterisactive="+filterIsActiveValue+"&rowperpage="+rowPerPage;
    }
    function redirectToCreate(){
        window.location.href = window.location.href.split('?')[0]+"/create";
    }
    
    function setPostRenderDefault(){
        for (const option of document.getElementById('isactive-filter-select')) {
            if(option.value=={{$params['requestQueryString']['filterIsActiveValue']}}){
                option.selected=true;
                break;
            };
        }
    }
    setPostRenderDefault();
</script>
@endsection