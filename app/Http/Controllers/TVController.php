<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TVController extends Controller
{
    public function tvpoli(){
        return view('tvpoli');
    }

    public function tvpoli2(){
        return view('tvpoli2');
    }

    public function admintvpoli(){
        return view('admintvpoli');
    }

    public function admintvpoli2(){
        return view('admintvpoli2');
    }

    public function tv(){
        $idunitkerja = Auth::user()->idunitkerja;
        $dataunit =DB::table('munitkerja')->select('nama')->where('noid', $idunitkerja)->first();
        $d = array();
        $d['nama'] = $dataunit->nama;
        return view('tv', compact('d'));
    }

    public function tvutama(){
        return view('tvutama');
    }

}
