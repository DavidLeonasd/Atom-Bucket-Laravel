@extends('template')
@section('content')    
<h1>Create Dompet</h1>
{!! Form::open(['action' => 'dompetController@store', 'method'=>'POST']) !!}
    <div class="form-group">
        {{Form::label('f_nama', 'Nama')}}
        {{Form::text('f_nama', '', ['placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_referensi', 'Referensi')}}
        {{Form::text('f_referensi', '', ['placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_deskripsi', 'Deskripsi')}}
        {{Form::textarea('f_deskripsi', '', ['placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_isactive', 'Status')}}
        {{Form::select('f_isactive',[
            1=>'Aktif',
            0=>'Tidak Aktif'
        ])}}
    </div>
    {{Form::submit('Save')}}
{!! Form::close() !!}
@endsection
