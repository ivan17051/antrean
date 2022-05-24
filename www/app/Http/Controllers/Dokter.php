<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;

class Dokter extends Controller {
    
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
        $d['listpoli'] = DB::select("SELECT idbppoli, policaption FROM munitkerjapoli WHERE idunitkerja = $idunitkerja AND isactive = 1 AND isdirectqueue = 1");
        
        return View::make('dokter', compact('d'));
    }

    public function show(){
        $idunitkerja = Auth::user()->idunitkerja;
        $dokter=DB::table('mdokter')
            ->select('mdokter.*','mbppoli.nama as namapoli')
            ->leftJoin('mbppoli', 'mdokter.idbppoli', '=', 'mbppoli.noid')
            ->where('idunitkerja',$idunitkerja)
            ->get();
        return response()->json($dokter);
    }

    public function storeUpdate(Request $request, $noid = null){
        $input = $request->only(
            'idbppoli',
            'nakes',
			'nik',
            'jamawal',
            'jamakhir',
            'isavailable',
            'isdokter'
        );
        
        $input = array_map('trim', $input);
        
        $user = Auth::user();
        $idunitkerja = $user->idunitkerja;
        
        $input['isavailable'] = empty($input['isavailable']) ? 0 : 1;
        $input['isdokter'] = empty($input['isdokter']) ? 0 : 1;
    
        try {
            if(isset($noid)){
                // UPDATE
                $input = array_merge($input, ['idmodif'=>$user->id] );
                $dokter = DB::table('mdokter')->where('noid', $noid)
                    ->update($input);
                return response()->json($dokter);
            }else{
                // STORE
                $input = array_merge($input, [
                    'idunitkerja' => $idunitkerja, 
                    'idcreate' => $user->id,
                    'idmodif' => $user->id,
                    ] );
                $id = DB::table('mdokter')->insertGetId($input);
                return response()->json(['id' => $id]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' =>  $e->getMessage() ], 403);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error!'], 403);
        }
    }
}