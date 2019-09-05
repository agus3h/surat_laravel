<?php

namespace App\Exports;

use App\Masuk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class MasukExport implements FromView
{
	use Exportable;
   public function view(): View
   {
   	return view('laporan.masuk',[
   		'masuk'=>Masuk::with('kategori')->where('status','Selesai')->get()
   	]);
   }
}