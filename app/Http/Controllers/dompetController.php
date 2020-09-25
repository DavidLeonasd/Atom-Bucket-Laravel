<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dompet;
class dompetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dompet= Dompet::sortable('id')->paginate(10);
        return view('dompet.dompet_home')->with('dompets',$dompet);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dompet.dompet_create_form');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate request input
        $this->validate($request, [
            'f_nama'=>'required|min:5',
            'f_description'=>'max:100'
        ]);

        //create record
        $dompet=new Dompet;
        $dompet->nama=$request->input('f_nama');
        $dompet->referensi=$request->input('f_referensi');
        $dompet->deskripsi=$request->input('f_deskripsi');
        $dompet->isactive=$request->input('f_isactive');
        $dompet->save();

        return redirect('/dompet');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dompet=Dompet::find($id);
        return view('dompet.dompet_detail')->with('dompet', $dompet);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dompet=Dompet::find($id);
        return view('dompet.dompet_update_form')->with('dompet', $dompet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'f_nama'=>'required|min:5',
            'f_description'=>'max:100'
        ]);
        $dompet=Dompet::find($id);
        $dompet->nama=$request->input('f_nama');
        $dompet->referensi=$request->input('f_referensi');
        $dompet->deskripsi=$request->input('f_deskripsi');
        $dompet->isactive=$request->input('f_isactive');
        $dompet->save();

        return redirect('/dompet');
    }

    public function updateStatus($id, $isactive)
    {   
        $dompet=Dompet::find($id);
        $dompet->isactive=$isactive;
        $dompet->save();

        return redirect('/dompet');
    }

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
