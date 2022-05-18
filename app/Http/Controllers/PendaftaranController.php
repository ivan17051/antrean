<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitKerja;
use App\Poliklinik;

class PendaftaranController extends Controller
{
    public function daftarOnline(){
        $puskesmas = UnitKerja::where('nama','LIKE','Puskesmas%')->get();
        $rs = UnitKerja::where('nama','LIKE','RSUD%')->get();
        $poli = Poliklinik::all();
        
        return view('daftarOnline', ['puskesmas'=>$puskesmas, 'rs'=>$rs, 'poli'=>$poli]);
    }
}
