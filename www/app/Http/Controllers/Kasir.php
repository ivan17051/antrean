<?php namespace App\Http\Controllers;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;


class Kasir extends Controller {
    
    public function index() {

        $idunitkerja = Auth::user()->idunitkerja;
        $d = array();
        $d['title'] = "Daftar Pasien";
        $d['subtitle'] = "antrian";
        
        $d['idunitkerja'] = $idunitkerja;
        $d['listpoli'] = DB::select("SELECT idbppoli, policaption FROM munitkerjapoli WHERE idunitkerja = $idunitkerja AND isactive = 1 AND isdirectqueue = 1");

        return View::make('kasir', compact('d'));
        // print_r($d);
    }
}