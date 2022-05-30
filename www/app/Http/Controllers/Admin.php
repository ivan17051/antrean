<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;


class Admin extends Controller {
    
    public function index(Request $request) {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $d = array();
        $d['title'] = "Dashboard Admin";
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
	
        $d['listpoli'] =DB::select("SELECT idbppoli, policaption FROM munitkerjapoli WHERE idunitkerja = $idunitkerja AND isactive = 1 AND isdirectqueue = 1");
    
        return View::make('admin', compact('d'));
        // print_r($d);
    }

    public function getPoliUtama($tipe,$idunitkerja){
        $idUnit = 1;//Input::get('idunitkerja');
        if ($tipe == 1) {
            $query = "SELECT * FROM mpoli WHERE idunitkerja = '$idunitkerja' AND idpoli IN (1,2,3) ";
        } else {
            $query = "SELECT * FROM mpoli WHERE idunitkerja = '$idunitkerja' AND idpoli NOT IN (1,2,3) ";
        }
        
        $data = DB::select($query);
        return Response::json(array('data' => $data));
    }

}