<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;

class Loket extends Controller {
    
    public function index() {
        $idunitkerja = Auth::user()->idunitkerja;
        $d = array();
        $d['title'] = "Daftar Pasien";
        $d['subtitle'] = "antrian";
        
        $d['idunitkerja'] = $idunitkerja;
        $d['listpoli'] = DB::select("SELECT idbppoli, policaption FROM munitkerjapoli WHERE idunitkerja = $idunitkerja AND isactive = 1 AND isdirectqueue = 1");

        return View::make('loket', compact('d'));
        // print_r($d);
    }

    public function index2() {
        $idunitkerja = Auth::user()->idunitkerja;
        $d = array();
        $d['title'] = "Daftar Pasien";
        $d['subtitle'] = "antrian";
        
        $d['idunitkerja'] = $idunitkerja;
        $d['listpoli'] = DB::select("SELECT idbppoli, policaption FROM munitkerjapoli WHERE idunitkerja = $idunitkerja AND isactive = 1 AND isdirectqueue = 1");

        return View::make('loket2', compact('d'));
        // print_r($d);
    }

    public function update(Request $request, $noid = null){
        date_default_timezone_set("Asia/Jakarta");
        $datenow = date("Y-m-d h:i:s");
    
        try {
            // UPDATE
            $input = ['isconfirm'=>1, 'doconfirm'=>$datenow] ;
            $antrian = DB::table('mantrian')->where('noid', $noid)
                ->update($input);
            return redirect('/loket2');
            
        } catch (\Exception $e) {
            return response()->json(['message' =>  $e->getMessage() ], 403);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error!'], 403);
        }
    }
}