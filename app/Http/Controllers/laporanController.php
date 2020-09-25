<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi;
use \DB;
class laporanController extends Controller
{

    public function formLaporanTransaksi()
    {
        $dompets=DB::table('dompet')
            ->select(DB::raw('id,nama'))
            ->where('isactive', '=', 1)
            ->orderBy('nama')
            ->get()
            ->pluck('nama','id')->all();
        $dompets+=[null=>''];
        $kategoris=DB::table('kategori')
            ->select(DB::raw('id, nama'))
            ->where('isactive', '=', 1)
            ->orderBy('nama')
            ->get()
            ->pluck('nama','id')->all();
        $kategoris+=[null=>''];
        return view('laporan.laporan_transaksi_form')->with('listData', array('dompets'=>$dompets, 'kategoris'=>$kategoris));    

    }

    public function generateLaporanTransaksi(Request $request)
    {
        $this->validate($request,[
            'f_tanggal_awal'=>'required',
            'f_tanggal_akhir'=>'required'
        ]);
        $queryOrderBy='tanggal';
        $queryOrderAscDesc='asc';
        $queryBuilder=DB::table('transaksi')
        ->select('transaksi.*', 'dompet.nama as dompet_nama', 'kategori.nama as kategori_nama')
        ->join('dompet', 'dompet.id', '=', 'transaksi.dompet_id')
        ->leftJoin('kategori', 'kategori.id', '=', 'transaksi.kategori_id')
        ->where('tanggal','>=', $request->input('f_tanggal_awal'))
        ->where('tanggal','<=', $request->input('f_tanggal_akhir'))
        ->whereIn('istransaksimasuk', $request->input('f_transaksi')??[]);
        if($request->input('f_kategori_id')>0)
            $queryBuilder->where('kategori_id','=', $request->input('f_kategori_id')??'kategori_id');
        if($request->input('f_dompet_id')>0)
            $queryBuilder->where('dompet_id','=', $request->input('f_dompet_id')?:'dompet_id');
        $transaksis=$queryBuilder->orderBy($queryOrderBy, $queryOrderAscDesc)
        ->get();

        $sumMasuk=(clone $queryBuilder)->where('istransaksimasuk',1)->sum('nilai');
        $sumKeluar=(clone $queryBuilder)->where('istransaksimasuk',0)->sum('nilai');
        $transaksisSum=[
            'masuk'=>$sumMasuk,
            'keluar'=>$sumKeluar,
            'total'=>$sumMasuk+$sumKeluar       
        ];
        return view('laporan.laporan_transaksi_output')->with('data',[
            'transaksis'=>$transaksis,
            'transaksisSum'=>$transaksisSum
        ]);
    }
}
