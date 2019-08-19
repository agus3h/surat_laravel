<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $kategori=Kategori::orderBy('created_at','DESC')->paginate(5);
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'nama'=>'required|max:50'
        ];
        $pesan=[
            'nama.required'=>'Nama kategori harus diisi..!!!',
            'nama.max'=>'Nama kategori maksimal 50 karakter..!!!'
        ];
        $this->validate($request,$rules,$pesan);
        $n=$request->nama;
        
        $kategori=Kategori::firstOrCreate([
            'nama'=> $n
        ]);
        return redirect(route('kategori.index'))->with('tambah','Kategori : '.$kategori->nama.' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $kategori= Kategori::findOrFail($id);
         return view('kategori.edit',compact('kategori'));
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
        $rules=[
            'nama'=>'required|max:50'
        ];
        $pesan=[
            'nama.required'=>'nama harus diisi',
            'nama.max:50'=>'nama maksimal 50 karakter'
        ];
        $this->validate($request,$rules,$pesan);
        $n=$request->nama;
        
         $kategori=Kategori::findOrFail($id);
        Kategori::find($id)->update([
            'nama'=> $n,
        ]);
         return redirect('/kategori')->with('edit','Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori=Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->back()->with('delete','Kategori '.$kategori->nama.' berhasil dihapus');
    }
}
