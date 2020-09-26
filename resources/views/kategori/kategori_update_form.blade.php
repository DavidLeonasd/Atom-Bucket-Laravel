@extends('template')
@section('content')    
<div class="title">
    <h1>Kategori Update</h1>
</div>
{!! Form::open(['action' => ['kategoriController@update', $kategori->id], 'method'=>'POST']) !!}

    <div class="form-group">
        {{Form::label('f_nama', 'Nama')}}
        {{Form::text('f_nama', $kategori->nama, ['placeholder'=>'nama'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_deskripsi', 'Deskripsi')}}
        {{Form::textarea('f_deskripsi', $kategori->deskripsi, ['placeholder'=>'deskripsi'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_isactive', 'Status')}}
        {{Form::select('f_isactive',[
            1=>'Aktif',
            0=>'Tidak Aktif'
        ])}}
    </div>

    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Save')}}
{!! Form::close() !!}
@endsection
