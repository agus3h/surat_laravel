<?php

namespace App\Exports;

use App\Keluar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class KeluarExport implements FromView
{
	use Exportable;
   public function View(): View
   {
   	return view('laporan.keluar',[
   		'keluar'=>Keluar::with('kategori')->where('status','Selesai')->get()
   	]);
   }
}