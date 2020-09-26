<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\V_Transaksi;
use \DB;
class transaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $InOut)
    {
        if($InOut!='masuk' && $InOut!='keluar'){
            return redirect('/dompet');
        }
        $isMasuk=$InOut=='masuk'?1:0;
        $query=V_Transaksi::where('istransaksimasuk','=',$isMasuk)->sortable();
        $filterWord=$request->query('filterword')??'';
        $rowPerPage=$request->query('rowperpage')??10;

        if($filterWord){
            $query->where(function ($innerWhere) {
                global $request;
                $innerWhere
                    ->orWhereRaw("DATE_FORMAT(tanggal, '%d-%m-%Y') like '%".$request->query('filterword')."%'")
                    ->orwhere('kode','like','%'.$request->query('filterword').'%')
                    ->orwhere('deskripsi','like','%'.$request->query('filterword').'%')
                    ->orwhere('kategori_nama','like','%'.$request->query('filterword').'%');
                    // ->orwhere('dompet_nama','like','%'.$request->query('filterword').'%');
            });
       }
        $transaksis=$query->paginate($rowPerPage);
        $requestQueryString=[
            'filterWordInput'=>$filterWord,
            'rowPerPage'=>$rowPerPage
        ];
        return view('transaksi.transaksi_home')->with('params',[
            'transaksis'=>$transaksis,
            'requestQueryString'=>$requestQueryString,
            'isMasuk'=>$isMasuk
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($InOut)
    {
        $IsMasuk=$InOut=='masuk'?1:0;
        $dompets=DB::table('dompet')
            ->select(DB::raw('id,nama'))
            ->where('isactive', '=', 1)
            ->orderBy('nama')
            ->get()
            ->pluck('nama','id')->all();
        $kategoris=DB::table('kategori')
            ->select(DB::raw('id, nama'))
            ->where('isactive', '=', 1)
            ->orderBy('nama')
            ->get()
            ->pluck('nama','id')->all();
        $kategoris+=[''=>''];
        return view('transaksi.transaksi_create_form')->with('listData', array('ismasuk'=>$IsMasuk, 'dompets'=>$dompets, 'kategoris'=>$kategoris));    
        // return $dompets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'f_tanggal'=>'required',
            'f_dompet_id'=>'required',
            'f_nilai'=>'gt:0',            
            'f_description'=>'max:100'
        ]);

        $transaksi=new Transaksi;
        DB::beginTransaction();
        try{
            DB::table('transaksi_type')
            ->where('nama', '=', $request->input('f_istransaksimasuk')==1?'dompet_masuk':'dompet_keluar')
            ->increment('current_no');

            $transaksi_type=DB::table('transaksi_type')
                ->select('id','prefix','current_no')
                ->where('nama', '=', $request->input('f_istransaksimasuk')==1?'dompet_masuk':'dompet_keluar')
                ->get();           

            //create record
            $transaksi->kode=$transaksi_type[0]->prefix.$transaksi_type[0]->current_no;
            $transaksi->tanggal=$request->input('f_tanggal');
            $transaksi->deskripsi=$request->input('f_deskripsi');
            $transaksi->kategori_id=$request->input('f_kategori_id');
            $transaksi->dompet_id=$request->input('f_dompet_id');
            $transaksi->istransaksimasuk=$request->input('f_istransaksimasuk');
            $transaksi->transaksi_type_id=$transaksi_type[0]->id;

            $temp=$request->input('f_istransaksimasuk')==1?$request->input('f_nilai'):$request->input('f_nilai')*-1;
            $transaksi->nilai=$temp;

            $transaksi->save();
            
        }
        catch(\Exception $e){
            DB::rollback();
            return $e;
        }
        DB::commit();
        $InOut=$transaksi->istransaksimasuk==1?'masuk':'keluar';
        return redirect('/transaksi/'.$InOut.'/a');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($param1, $param2)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {

    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}