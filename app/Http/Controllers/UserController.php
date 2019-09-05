<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
        $user=User::orderBy('created_at','DESC')->paginate(5);
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('user.create');
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
             'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
        ];
        $pesan=[
            'nama.required'=>'Nama kategori harus diisi..!!!',
            'nama.max'=>'Nama kategori maksimal 50 karakter..!!!'
        ];
        $this->validate($request,$rules,$pesan);
        $n=$request->name;
        $e=$request->email;
        $r=$request->role;
        $p=$request->password;
        
        $user=User::create([
             'name' => $n,
            'email' => $e,
            'role' =>$r,
            'password' => bcrypt($p),
        ]);
        return redirect(route('user.index'))->with('tambah','User : '.$user->name.' berhasil ditambahkan');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $user=User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('delete','User '.$user->name.' berhasil dihapus');
    }
}
