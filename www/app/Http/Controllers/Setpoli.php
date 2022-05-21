<?php namespace App\Http\Controllers;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
use Illuminate\Http\Request;
use Exception;
use Schema;
use Illuminate\Database\QueryException;


class Setpoli extends Controller {
	
	public function index(){
		$d = array();
        $d['title'] = "Daftar Antrian";
        $d['subtitle'] = "antrian";
        $d['idunitkerja'] = Auth::user()->idunitkerja;
        $d['listpoli'] = DB::select("SELECT idbppoli, policaption FROM munitkerjapoli WHERE idunitkerja = 42 AND isactive = 1 AND isdirectqueue = 1");
        return View::make('setpoli', compact('d'));
	}

	public function getPoliUnit(){
		
        $idunitkerja = Auth::user()->idunitkerja;
       
        $where   = " where a.idunitkerja='$idunitkerja' ";
       
        $text  = " SELECT b.kode,b.nama,a.* FROM munitkerjapoli a
				   LEFT JOIN mbppoli b on a.idbppoli = b.noid
                   $where 
                   ORDER BY a.nourut ";

        $query = DB::select("SELECT b.kode,b.nama,a.* FROM munitkerjapoli a LEFT JOIN mbppoli b on a.idbppoli = b.noid $where ORDER BY a.nourut");
        
        $output = array();
        
        $output["aData"] = $query;

        // $query->free_result();

        return $output;        
    }

    public function getDetail(){
		
        $idunitkerja = Auth::user()->idunitkerja;
        $idbppoli = Input::get('idbppoli');

        $where   = " WHERE idbppoli='$idbppoli' AND idunitkerja='$idunitkerja'";

        $text    = "SELECT * FROM munitkerjapoli $where ";
        $q       = DB::select($text);

        if($q>0){
            foreach ($q as $row)
            {
                $rows[] = $row;
            }
            // $q->free_result();
            echo json_encode(array_shift($rows));
        }
    }

	public function simpan(Request $request){
		
		DB::beginTransaction();
        $idreturn;
        try {
	        $idunitkerja = Auth::user()->idunitkerja;
	        $idbppoli    = Input::get('idbppoli');

	        if (isset($idbppoli)){
	            $p   = array();
	            $tbl = 'munitkerjapoli';//$this->input->post('tbl');
	            $input = $request->all();
	            foreach ($input as $key => $value ){
	                if(Schema::hasColumn($tbl, $key)) {
	                    $p[$key] = Input::get($key);
	                }
	            }
	            unset($p['noid'],$p['idbppoli'],$p['nourut']);            
	            $nourut  = Input::get('nourut');
	            if(empty($nourut)){
	                $nourut=0;
	            }

	            $a = array('nourut'=>$nourut,
	                'idupdate'=>Auth::user()->id,
	                'lastupdate'=>date('Y-m-d H:i:s')                
	            );   

	            DB::table($tbl)->where(array('idbppoli'=>$idbppoli,'idunitkerja'=>$idunitkerja))->update(array_merge($p,$a));
				
	            $tanggal = date('Y-m-d');
	           DB::select("UPDATE munitkerjapolidaily a
	            	LEFT JOIN munitkerjapoli b ON a.idunitkerja = b.idunitkerja AND a.idbppoli = b.idbppoli
	            	SET a.avgservice = b.avgservice,
	            		a.noserver   = b.noserver,
                        a.jambuka    =
                            (CASE WHEN DAYOFWEEK(a.servesdate)=1 THEN b.jambuka07
                                  WHEN DAYOFWEEK(a.servesdate)=2 THEN b.jambuka01
                                  WHEN DAYOFWEEK(a.servesdate)=3 THEN b.jambuka02
                                  WHEN DAYOFWEEK(a.servesdate)=4 THEN b.jambuka03
                                  WHEN DAYOFWEEK(a.servesdate)=5 THEN b.jambuka04
                                  WHEN DAYOFWEEK(a.servesdate)=6 THEN b.jambuka05
                                  WHEN DAYOFWEEK(a.servesdate)=7 THEN b.jambuka06
                                  ELSE
                                  b.jambuka
                            END),
                        a.jamlayanan =
                        (CASE WHEN DAYOFWEEK(a.servesdate)=1 THEN b.jamlayanan07
                              WHEN DAYOFWEEK(a.servesdate)=2 THEN b.jamlayanan01
                              WHEN DAYOFWEEK(a.servesdate)=3 THEN b.jamlayanan02
                              WHEN DAYOFWEEK(a.servesdate)=4 THEN b.jamlayanan03
                              WHEN DAYOFWEEK(a.servesdate)=5 THEN b.jamlayanan04
                              WHEN DAYOFWEEK(a.servesdate)=6 THEN b.jamlayanan05
                              WHEN DAYOFWEEK(a.servesdate)=7 THEN b.jamlayanan06
                              ELSE
                              b.jamlayanan
                        END),
                        a.jamtutup   =
                        (CASE WHEN DAYOFWEEK(a.servesdate)=1 THEN b.jamtutup07
                              WHEN DAYOFWEEK(a.servesdate)=2 THEN b.jamtutup01
                              WHEN DAYOFWEEK(a.servesdate)=3 THEN b.jamtutup02
                              WHEN DAYOFWEEK(a.servesdate)=4 THEN b.jamtutup03
                              WHEN DAYOFWEEK(a.servesdate)=5 THEN b.jamtutup04
                              WHEN DAYOFWEEK(a.servesdate)=6 THEN b.jamtutup05
                              WHEN DAYOFWEEK(a.servesdate)=7 THEN b.jamtutup06
                              ELSE
                              b.jamtutup
                        END)
                    WHERE a.idunitkerja='$idunitkerja' AND a.idbppoli='$idbppoli' AND a.servesdate>='$tanggal'");
	            $idreturn = 1;
	        }
	    } catch(QueryException $e){ 
            DB::rollback();
            $idreturn = "Internal Server Error";
        } catch (Exception $e) {
            DB::rollback();
            $idreturn = $e->getMessage();
        }
        DB::commit();

        return $idreturn;
	}
}