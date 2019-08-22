<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Masuk;
use App\Kategori;
use File;
use Image;


class SuratMasukController extends Controller
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
          
        if (Auth::user()->role=='pencatat') {
        $masuk=Masuk::orderBy('created_at','DESC')->where('status','Diproses')->paginate(5);  
        return view('surat_masuk.indexpencatat', compact('masuk'));
       }
        $masuk=Masuk::with('kategori')->orderBy('created_at','DESC')->paginate(5);
        return view('surat_masuk.index', compact('masuk'));
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role=='pencatat') {
        $kategori=Kategori::orderBy('nama')->get();
        return view('surat_masuk.createpencatat',compact('kategori'));
        }
         $kategori=Kategori::orderBy('nama')->get();
        return view('surat_masuk.create',compact('kategori'));
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
            'dari'=>'required|max:50',
            'nomor'=>'required|max:50',
            'perihal'=>'required|max:50',
            'kategori_id' => 'required|exists:kategoris,id',
            'catatan'=>'required|max:500',
            'status'=>'required',
            'file'=>'nullable|mimes:jpg,jpeg,png|max:2084'
        ];
        $pesan=[
            'dari.required'=>'Surat dari siapa..!!!',
            'dari.max'=>'Maksimal 50 karakter..!!!',
            'nomor.required'=>'Nomor surat harus diisi..!!!',
            'nomor.max'=>'Maksimal 50 karakter..!!!',
            'perihal.required'=>'Perihal harus diisi..!!!',
            'perihal.max'=>'Maksimal 50 karakter..!!!',
            'catatan.required'=>'Catatan harus diisi..!!!',
            'catatan.max'=>'Maksimal 500 karakter..!!!',
            'status.required'=>'Status harus diisi..!!!',
            'kategori_id.required'=>'Kategori harus dipilih..!!!',
            'file.mimes'=>'Format file harus jpg,jpeg atau png..!!!',
            'file.max'=>'File terlalu besar..!!!'
        ];

        $this->validate($request,$rules,$pesan);
        $n=$request->nomor;
        $d=$request->dari;
        $p=$request->perihal;
        $c=$request->catatan;
        $s=$request->status;
        $ki=$request->kategori_id;
        $f=$request->file;
       

        $file=null;
        if ($request->hasFile('file')) {
            $file=$this->saveFile($request->dari,$request->file('file'));
        }
       

         $masuk=Masuk::create([
            'nomor'=> $n,
            'dari'=> $d,
            'perihal'=> $p,
            'catatan'=> $c,
            'status'=> $s,
            'kategori_id'=> $ki,
            'file'=> $file
        ]);
        return redirect(route('surat_masuk.index'))->with('tambah','Surat : '.$masuk->dari.' berhasil ditambahkan');
    }

    private function saveFile($d,$f){
        $images=str_slug($d).time().'.'.$f->getClientOriginalExtension();
        $path=public_path('uploads/surat_masuk');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path,0777,true,true);
    }
        Image::make($f)->save($path.'/'.$images);
        return $images;
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
        if (Auth::user()->role=='pencatat') {
        $masuk= Masuk::findOrFail($id);    
        $kategori=Kategori::orderBy('nama')->get();
        return view('surat_masuk.editpencatat',compact('masuk','kategori'));
        // return redirect(route('home'));
        }
        $masuk= Masuk::findOrFail($id);
        $kategori=Kategori::orderBy('nama')->get();
        return view('surat_masuk.edit',compact('masuk','kategori'));
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
            'dari'=>'required|max:50',
            'nomor'=>'required|max:50',
            'perihal'=>'required|max:50',
            'kategori_id' => 'required|exists:kategoris,id',
            'catatan'=>'required|max:500',
            'status'=>'required',
            'file'=>'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ];
        $pesan=[
            'dari.required'=>'Surat dari siapa..!!!',
            'dari.max'=>'Maksimal 50 karakter..!!!',
            'nomor.required'=>'Nomor surat harus diisi..!!!',
            'nomor.max'=>'Maksimal 50 karakter..!!!',
            'perihal.required'=>'Perihal harus diisi..!!!',
            'perihal.max'=>'Maksimal 50 karakter..!!!',
            'catatan.required'=>'Catatan harus diisi..!!!',
            'catatan.max'=>'Maksimal 500 karakter..!!!',
            'status.required'=>'Status harus diisi..!!!',
            'kategori_id.required'=>'Kategori harus dipilih..!!!',
            'file.mimes'=>'Format file harus jpg,jpeg atau png..!!!',
            'file.max'=>'File terlalu besar..!!!'
        ];


        $masuk= Masuk::findOrFail($id);   
        $file=$masuk->file;

        if ($request->hasFile('file')) {
            !empty($file) ? File::delete(public_path('uploads/surat_masuk/'.$file)):null;
            $file=$this->saveFile($request->dari,$request->file('file'));
        }
        
       

        $this->validate($request,$rules,$pesan);
        $n=$request->nomor;
        $d=$request->dari;
        $p=$request->perihal;
        $c=$request->catatan;
        $s=$request->status;
        $ki=$request->kategori_id;
        $f=$request->file;

         
        Masuk::find($id)->update([
            'nomor'=> $n,
            'dari'=> $d,
            'perihal'=> $p,
            'catatan'=> $c,
            'status'=> $s,
            'kategori_id'=> $ki,
            'file'=> $file
        ]);

        return redirect(route('surat_masuk.index'))->with('edit','Surat berhasil diubah');
    }


     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        //query select data berdasarkan id
        $masuk= Masuk::findOrFail($id);
        //mengecek jika filed file tidak kosogn
        if (!empty($masuk->file)) {
            //hapus file dari folder
            File::delete(public_path('uploads/surat_masuk/'.$masuk->file));
        }
        //hapus data dari table
        $masuk->delete();
        return redirect(route('surat_masuk.index'))->with('delete','Surat : '.$masuk->dari.' berhasil dihapus');
    }
}
