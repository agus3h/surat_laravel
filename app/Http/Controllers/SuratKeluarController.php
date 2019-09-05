<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Keluar;
use App\Kategori;
use File;
use Image;
use App\Exports\KeluarExport;

class SuratKeluarController extends Controller
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
        $keluar=Keluar::orderBy('created_at','DESC')->where('status','Diproses')->paginate(5);
        return view('surat_keluar.indexpencatat', compact('keluar'));    
        }
        $keluar=Keluar::with('kategori')->orderBy('created_at','DESC')->paginate(5);
        return view('surat_keluar.index', compact('keluar'));
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
        return view('surat_keluar.createpencatat',compact('kategori'));
        }    
        $kategori=Kategori::orderBy('nama')->get();
        return view('surat_keluar.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [ 
            'kepada'=>'required|max:50',
            'nomor'=>'required|max:50',
            'perihal'=>'required|max:50',
            'kategori_id' => 'required|exists:kategoris,id',
            'catatan'=>'nullable|max:100',
            'status'=>'required',
            'file'=>'nullable|mimes:jpg,jpeg,png|max:2048'
            ],
            [
            'kepada.required'=>'Surat ditujukan kepada siapa..!!!',
            'kepada.max'=>'Maksimal 50 karakter..!!!',
            'nomor.required'=>'Nomor surat harus diisi..!!!',
            'nomor.max'=>'Maksimal 50 karakter..!!!',
            'perihal.required'=>'Perihal harus diisi..!!!',
            'perihal.max'=>'Maksimal 50 karakter..!!!',
            'catatan.max'=>'Maksimal 100 karakter..!!!',
            'status.required'=>'Status harus diisi..!!!',
            'kategori_id.required'=>'Kategori harus dipilih..!!!',
            'file.mimes'=>'Format file harus jpg,jpeg atau png..!!!'
        ]);
        

     
        $n=$request->nomor;
        $k=$request->kepada;
        $p=$request->perihal;
        $c=$request->catatan;
        $s=$request->status;
        $ki=$request->kategori_id;
        $f=$request->file;


       $file=null;
        if ($request->hasFile('file')) {
            $file=$this->saveFile($request->kepada,$request->file('file'));
        }

        
         $keluar=Keluar::create([
            'nomor'=> $n,
            'kepada'=> $k,
            'perihal'=> $p,
            'catatan'=> $c,
            'status'=> $s,
            'kategori_id'=> $ki,
            'file'=> $file
        ]);
        return redirect(route('surat_keluar.index'))->with('tambah','Surat : '.$keluar->kepada.' berhasil ditambahkan');
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

     public function proses(Request $request, $id)
    {
        $keluar= Keluar::findOrFail($id);
        $keluar::find($id)->update(['status'=>'Selesai']); 
        return redirect(route('surat_keluar.index'));
    }

    public function selesai(Request $request, $id)
    {
        $keluar= Keluar::findOrFail($id);
        $keluar::find($id)->update(['status'=>'Diproses']); 
        return redirect(route('surat_keluar.index'));
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
            // $keluar= Keluar::findOrFail($id);    
            //  $kategori=Kategori::orderBy('nama')->get();
            // return view('surat_keluar.editpencatat',compact('keluar','kategori'));
            return redirect('home');
        }
         $keluar= Keluar::findOrFail($id);
         $kategori=Kategori::orderBy('nama')->get();
       
         return view('surat_keluar.edit',compact('keluar','kategori'));
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
            'kepada'=>'required|max:50',
            'nomor'=>'required|max:50',
            'perihal'=>'required|max:50',
            'kategori_id' => 'required|exists:kategoris,id',
            'catatan'=>'nullable|max:100',
            'status'=>'required',
            'file'=>'nullable|image|mimes:jpg,jpeg,png|max:2084'
        ];
        $pesan=[
            'kepada.required'=>'Field kepada harus diisi',
            'kepada.max'=>'maksimal 50 karakter',
            'nomor.required'=>'nomor harus diisi',
            'nomor.max'=>'maksimal 50 karakter',
            'perihal.required'=>'perihal harus diisi',
            'perihal.max'=>'maksimal 50 karakter',
            'catatan.required'=>'Catatan harus diisi',
            'catatan.max'=>'maksimal 100 karakter',
            'status.required'=>'Status harus diisi',
            'kategori_id.required'=>'Kategori harus diisi',
            'file.mimes:jpg,png,jpeg'=>'Format file harus jpg,jpeg atau png',
            'file.max'=>'File terlalu besar'
        ];


        $this->validate($request,$rules,$pesan);
        $n=$request->nomor;
        $k=$request->kepada;
        $p=$request->perihal;
        $c=$request->catatan;
        $s=$request->status;
        $ki=$request->kategori_id;
        $f=$request->file;

        $keluar= Keluar::findOrFail($id);   
        $file=$keluar->file;

        if ($request->hasFile('file')) {
            !empty($file) ? File::delete(public_path('uploads/surat_keluar/'.$file)):null;
            $file=$this->saveFile($request->kepada,$request->file('file'));
        }
        
        Keluar::find($id)->update([
            'nomor'=> $n,
            'kepada'=> $k,
            'perihal'=> $p,
            'catatan'=> $c,
            'status'=> $s,
            'kategori_id'=> $ki,
            'file'=> $file
        ]);
        return redirect(route('surat_keluar.index'))->with('edit','Surat berhasil diubah');
    }


    private function saveFile($k,$f){
        $images=str_slug($k).time().'.'.$f->getClientOriginalExtension();
        $path=public_path('uploads/surat_keluar');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path,0777,true,true);
    }
        Image::make($f)->save($path.'/'.$images);
        return $images;
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
        $keluar= Keluar::findOrFail($id);
        //mengecek jika filed photo tidak kosogn
        if (!empty($keluar->file)) {
            //hapus file dari folder
            File::delete(public_path('uploads/surat_keluar/'.$keluar->file));
        }
        //hapus data dari table
        $keluar->delete();
        return redirect(route('surat_keluar.index'))->with('delete','Surat : '.$keluar->kepada.' berhasil dihapus');
    }
     public function excel(){
        return (new KeluarExport)->download('surat_keluar.xlsx');

    }
}
