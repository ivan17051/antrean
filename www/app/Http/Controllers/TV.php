<?php namespace App\Http\Controllers;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;

class TV extends Controller {
    
    public function index() {
	
        $idunitkerja = Auth::user()->idunitkerja;
        $dataunit = DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvstream', compact('d'));
        // print_r($d);
    }

    public function tvstream() {
		
        $idunitkerja = Auth::user()->idunitkerja;
        $dataunit = DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvstream', compact('d'));
        // print_r($d);
    }

    public function tvnonpanggilan() {
		
        $idunitkerja = Auth::user()->idunitkerja;
        $dataunit =DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvnonpanggilan', compact('d'));
        // print_r($d);
    }
	
	public function tvloket() {
        $idunitkerja = Auth::user()->idunitkerja;
        $dataunit =DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvloket', compact('d'));
    }

    public function tvloket2() {
        $idunitkerja = Auth::user()->idunitkerja;
        $dataunit =DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvloket2', compact('d'));
    }

    public function tvloket3() {
        $idunitkerja = Auth::user()->idunitkerja;
        $dataunit =DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvloket3', compact('d'));
    }

    public function tvloket4() {
        $idunitkerja = Auth::user()->idunitkerja;
        $dataunit =DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        if(!$dataunit){
            return View::make('errors/404');
        }
        $d = array();
        $d['title'] = $dataunit->nama;
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        
        return View::make('tvloket4', compact('d'));
    }
}