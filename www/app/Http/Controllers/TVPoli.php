<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;


class TVPoli extends Controller {
    
    public function index(Request $request) {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $dataunit = DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvpoli', compact('d'));
        // print_r($d);
    }
	
	public function index2(Request $request) {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $dataunit = DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvpoli3', compact('d'));
        // print_r($d);
    }

    public function index3(Request $request) {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $dataunit = DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvpoli4', compact('d'));
        // print_r($d);
    }

    public function index4(Request $request) {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $dataunit = DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvpoli5', compact('d'));
        // print_r($d);
    }
}