<?php namespace App\Http\Controllers;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;

class Detail extends Controller {
    
    public function index($idunitkerja,$idbppoli) {
        $d = array();
        $d['title'] = "Daftar Pasien";
        $d['subtitle'] = "antrian";
        
        $d['idunitkerja'] = $idunitkerja;
        $d['idbppoli'] = $idbppoli;
        return View::make('detail', compact('d'));
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

    public function getNomor($idunitkerja){
        $idUnit = 1;//Input::get('idunitkerja');
        
        $query = "SELECT A.* FROM noantrian A LEFT JOIN mpoli B ON A.idpoli = B.id WHERE B.idunitkerja = '$idunitkerja' ";
        
        $data = DB::select($query);
        return Response::json(array('data' => $data));

        // try{

        //     //API Url
        //     // $url = 'http://ehealth.surabaya.go.id/api/kominfo/getnomer/K/'.$nik;
        //     // $url = '172.18.1.207/api/kominfo/getnomer/K/'.$nik;
        //     $url = 'http://ehealth.surabaya.go.id/api/dispenduk/nik/'.$nik;

        //     //Initiate cURL.
        //     $ch = curl_init($url);

        //     $id        = "1101";
        //     $secretKey = "E3632DFCD8";
        //     date_default_timezone_set('UTC');
        //     $tStamp    = time();

        //     $auth      = hash_hmac('sha256', $id."&".$tStamp, $secretKey, true);
        //     $eauth     = base64_encode($auth);

        //     //Tell cURL that we want to send a POST request.
        //     // curl_setopt($ch, CURLOPT_POST, 1);

        //     //Attach our encoded JSON string to the POST fields.
        //     // curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        //     //Set the content type to application/json
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
        //                                             'x-id: '.$id,
        //                                             'x-date: '.$tStamp,
        //                                             'x-auth: '.$eauth));
        //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        //     curl_setopt($ch, CURLOPT_TIMEOUT, 350); //timeout in seconds

        //     //Execute the request
        //     $respon = curl_exec($ch);
        //     if(curl_errno($ch)){
        //         throw new Exception(curl_error($ch));
        //     }
        //     curl_close($ch);
        //     $json = json_decode($respon,true);
        //     // print_r($json);
        //     $output = array();
        //     // if ($json['meta']['code'] =="200"){
        //         $data = $json['respon'];//$json['respon'];
        //         $meta = $json['meta'];
        //     // } else {
        //     //     $data = $respon;
        //     // }
        //     $return = Response::json(array('data' => $data, 'meta' => $meta));
        // } catch (Exception $e) {
        //     $return = $e->getMessage();
        // }

        // return $return;
    }

    public function getDataPoli($idunitkerja, $idbppoli){
		
        $tanggal = '2019-05-07';//date('Y-m-d');
        $data = DB::select("SELECT A.nama, COALESCE(X.servesno, 0) AS noantrian, COALESCE(X.NAMA_LGKP, '-') AS pasien, X.*
            FROM mbppoli A
            LEFT JOIN ( SELECT A.*, B.NAMA_LGKP FROM munitkerjapolidaily A
                LEFT JOIN mantrianserve B ON A.idunitkerja = B.idunitkerja AND A.idbppoli = B.idbppoli AND A.servesno = B.pasiennoantrian AND CONCAT(A.servesdate, ' ', A.jambuka) = B.tanggalbuka
                WHERE A.idunitkerja = $idunitkerja AND A.idbppoli = $idbppoli AND A.servesdate = '$tanggal'
            ) X ON A.noid = X.idbppoli
            WHERE A.noid = $idbppoli");
        return Response::json(array('data' => $data));
    }

    public function getPasienPoli(){
        $tanggal = '2019-05-07';//date('Y-m-d');
        $idunitkerja = Input::get('idunitkerja');
        $idbppoli = Input::get('idbppoli');
        $data = DB::select("SELECT idunitkerja, idbppoli, pasiennoantrian, tanggaleta, NIK, NAMA_LGKP  FROM mantrian WHERE idunitkerja = $idunitkerja AND idbppoli = $idbppoli AND DATE(tanggalbuka) = '$tanggal' AND isexpired = 0
            UNION
            SELECT idunitkerja, idbppoli, pasiennoantrian, tanggaleta, NIK, NAMA_LGKP FROM mantrianserve WHERE idunitkerja = $idunitkerja AND idbppoli = $idbppoli AND DATE(tanggalbuka) = '$tanggal' ORDER BY pasiennoantrian ");
        return Response::json(array('data' => $data));
    }

}