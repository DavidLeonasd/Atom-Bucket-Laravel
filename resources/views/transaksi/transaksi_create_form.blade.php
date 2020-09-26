@extends('template')
@section('content')    
<div class="title">
    <h1>Transaksi Create</h1>
</div>
{!! Form::open(['action' => ['transaksiController@store', $listData['ismasuk']==1?'masuk':'keluar'], 'method'=>'POST']) !!}    
    <div class="form-group">
        {{Form::label('f_kode', 'Kode')}}
        {{Form::text('f_kode', '', ['placeholder'=>'xxxxxx','readonly'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_tanggal', 'Tanggal*')}}
        {{Form::date('f_tanggal', '',['required'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_nilai', 'Nilai*')}}
        {{Form::number('f_nilai', '', ['placeholder'=>'ex. 1000000', 'required'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_deskripsi', 'Deskripsi')}}
        {{Form::text('f_deskripsi', '', ['placeholder'=>'Description'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_kategori_id', 'Kategori')}}
        {{Form::select('f_kategori_id',$listData['kategoris'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_dompet_id', 'Dompet*')}}
        {{Form::select('f_dompet_id',$listData['dompets'],['required'])}}
    </div>

    <div class="form-group">
        {{Form::hidden('f_istransaksimasuk', $listData['ismasuk'])}}
    </div>

    {{Form::submit('Save')}}
{!! Form::close() !!}
@endsection
