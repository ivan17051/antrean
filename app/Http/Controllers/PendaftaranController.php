<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitKerja;
use App\Poliklinik;
use Carbon;

class PendaftaranController extends Controller
{
    public function daftarOnline(){
        $tanggal = [];
        array_push($tanggal, Carbon\Carbon::now());
        
        for($i=1;$i<90;$i++){
            array_push($tanggal, Carbon\Carbon::now()->addDays($i));
            
        }
        
        $puskesmas = UnitKerja::where('nama','LIKE','Puskesmas%')->get();
        $rs = UnitKerja::where('nama','LIKE','RSUD%')->get();
        $poli = Poliklinik::all();
        
        return view('daftarOnline', ['puskesmas'=>$puskesmas, 'rs'=>$rs, 'poli'=>$poli, 'tanggal'=>$tanggal]);
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
