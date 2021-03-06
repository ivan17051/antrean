<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UnitKerja;
use App\UnitKerjaPoli;
use App\Pasien;
use Carbon;

class PendaftaranController extends Controller
{
    public function daftarOnline(){
        // $tanggal = [];
        // array_push($tanggal, Carbon\Carbon::now());
        
        // for($i=1;$i<90;$i++){
        //     array_push($tanggal, Carbon\Carbon::now()->addDays($i));
        // }
        $pasien = Pasien::where('noid', Auth::user()->idpasien)->first();
        
        $puskesmas = UnitKerja::where('nama','LIKE','Puskesmas%')->get();
        $rs = UnitKerja::where('nama','LIKE','RSUD%')->get();
        $poli = UnitKerjaPoli::where('idunitkerja', Auth::user()->idunitkerja)->get();
        
        return view('daftarOnline2', ['pasien'=>$pasien, 'puskesmas'=>$puskesmas, 'rs'=>$rs, 'poli'=>$poli]);
    }

    public function daftar(Request $request) {

    }

    public function daftarOnSite(){
        $poli = UnitKerjaPoli::where('idunitkerja', Auth::user()->idunitkerja)->get();
        // dd($poli);
        return view('daftarOnSite', ['poli'=>$poli]);
    }

    public function daftarBarcode(){
        $poli = UnitKerjaPoli::where('idunitkerja', Auth::user()->idunitkerja)->get();

        return view('daftarBarcode', ['poli'=>$poli]);
    }
}
