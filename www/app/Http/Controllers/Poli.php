<?php namespace App\Http\Controllers;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;

class Poli extends Controller {
    
    public function index() {
        $idunitkerja = Auth::user()->idunitkerja;
        $d = array();
        $d['title'] = "Daftar Antrean";
        $d['subtitle'] = "antrean";
        $d['idunitkerja'] = $idunitkerja;
        $d['listpoli'] = DB::select("SELECT idbppoli, policaption FROM munitkerjapoli WHERE idunitkerja = $idunitkerja AND isactive = 1 AND isdirectqueue = 1");
        return View::make('poli', compact('d'));
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

    public function layaniantrian(){
		
        /*$tanggal = explode(' ',$_REQUEST['tanggalbuka']);
        $data['tanggal'] = $tanggal[0];
        $data['idunitkerja'] = $_REQUEST['idunitkerja'];
        $data['noantrian'] = $_REQUEST['pasiennoantrian'];
        $data['idbppoli'] = $_REQUEST['idbppoli'];
        $result = json_decode($this->postdata(URLWSANTRIAN.'10003',$data),true);
        $status = $result['status'];
      
        echo json_encode($result);
        */

        // $tanggal             = explode(' ',Input::get('tanggalbuka'));
        $data['tanggal']     = '2019-05-07';//date('Y-m-d');//Input::get('tanggal');//$tanggal[0];
        $data['idunitkerja'] = Input::get('idunitkerja');
        $data['noantrian']   = Input::get('pasiennoantrian');
        $data['idbppoli']    = Input::get('idbppoli');
        $data['id']          = '4';
        
        ob_start();    
        return Response::json($this->postdata('http://172.18.1.207/api/ehealth/antrianlbp',$data));
        ob_flush();
    
  }

    protected function postdata($url,$data=array()){
		
        $tStamp              = (time());
        $auth                = base64_encode(hash_hmac('sha256', "1234&".$tStamp, "979C18140B", true));
        $ch                  = curl_init();
        $headers             = array();
        $headers[]           = 'Accept: application/json';
        $headers[]           = 'Content-Type: application/json';
        $headers[]           = 'X-id:1234';
        $headers[]           = 'X-date:'.$tStamp;
        $headers[]           = 'X-auth:'.$auth;

        $lg                  = json_encode($data);
        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_CONNECTTIMEOUT => 5,
            //CURLOPT_TIMEOUT => 5,
            CURLOPT_CUSTOMREQUEST=>"POST",
            CURLOPT_POSTFIELDS=>$lg,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ));
        
        $response = curl_exec($ch) ;
        curl_close($ch);

        return json_decode($response);
  }

}