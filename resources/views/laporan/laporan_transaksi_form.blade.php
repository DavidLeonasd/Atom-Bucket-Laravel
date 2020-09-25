@extends('template')
@section('content')    
<h1>Create Kategori</h1>
{!! Form::open(['action' =>'laporanController@generateLaporanTransaksi', 'method'=>'POST']) !!}    
    <div class="form-group">
        {{Form::label('f_tanggal_awal', 'Tanggal Awal*')}}
        {{Form::date('f_tanggal_awal', '',['required'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_tanggal_akhir', 'Tanggal Akhir*')}}
        {{Form::date('f_tanggal_akhir', '',['required'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_kategori_id', 'Kategori')}}
        {{Form::select('f_kategori_id',$listData['kategoris'])}}
    </div>
    <div class="form-group">
        {{Form::label('f_dompet_id', 'Dompet')}}
        {{Form::select('f_dompet_id',$listData['dompets'])}}
    </div>

    <div class="form-group">
        {{Form::label('f_transaksi', 'Tampilkan Uang Masuk')}}
        {{Form::checkbox('f_transaksi[]', 1, true)}}
    </div>
    <div class="form-group">
        {{Form::label('f_transaksi', 'Tampilkan Uang Keluar')}}
        {{Form::checkbox('f_transaksi[]', 0, true)}}
    </div>

    {{Form::submit('Buat Laporan')}}
{!! Form::close() !!}
@endsection
