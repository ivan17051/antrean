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

    public function daftarOnSite(){
        $poli = Poliklinik::all();

        return view('daftarOnSite', ['poli'=>$poli]);
    }

    public function daftarBarcode(){
        $poli = Poliklinik::all();

        return view('daftarBarcode', ['poli'=>$poli]);
    }
}
