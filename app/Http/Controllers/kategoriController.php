<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;
class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori= kategori::orderBy('id')->paginate(10);
        return view('kategori.kategori_home')->with('kategoris',$kategori);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.kategori_create_form');
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
        $kategori=new kategori;
        $kategori->nama=$request->input('f_nama');
        $kategori->deskripsi=$request->input('f_deskripsi');
        $kategori->isactive=$request->input('f_isactive');
        $kategori->save();

        return redirect('/kategori');
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
        $kategori=kategori::find($id);
        return view('kategori.kategori_detail')->with('kategori', $kategori);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori=kategori::find($id);
        return view('kategori.kategori_update_form')->with('kategori', $kategori);
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
        $kategori=kategori::find($id);
        $kategori->nama=$request->input('f_nama');
        $kategori->deskripsi=$request->input('f_deskripsi');
        $kategori->isactive=$request->input('f_isactive');
        $kategori->save();

        return redirect('/kategori');
    }

    public function updateStatus($id, $isactive)
    {   
        $kategori=kategori::find($id);
        $kategori->isactive=$isactive;
        $kategori->save();

        return redirect('/kategori');
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