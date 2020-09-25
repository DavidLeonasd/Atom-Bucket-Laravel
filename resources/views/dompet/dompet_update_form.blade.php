@extends('template')
@section('content')    
<h1>Create Dompet</h1>
{!! Form::open(['action' => ['dompetController@update', $dompet->id], 'method'=>'POST']) !!}

    <div class="form-group">
        {{Form::label('f_nama', 'Nama')}}
        {{Form::text('f_nama', $dompet->nama, ['placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_referensi', 'Referensi')}}
        {{Form::text('f_referensi', $dompet->referensi, ['placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_deskripsi', 'Deskripsi')}}
        {{Form::textarea('f_deskripsi', $dompet->deskripsi, ['placeholder'=>'Title'])}}
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
