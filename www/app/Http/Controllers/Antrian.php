<?php

namespace App\Http\Controllers;

use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
use DateTime, DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\Http;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


class Antrian extends Controller
{

    public function getListPoli(Request $request)
    {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $wherepoli = "";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND idbppoli IN (" . implode(",", $filterpoli) . ") ";
        $query = "SELECT idbppoli AS id, policaption AS nama FROM munitkerjapoli WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = '$idunitkerja' $wherepoli ";
		
        $data = DB::connection('mysql')->select($query);
        return Response::json(array('data' => $data));
    }

    public function getNomor(Request $request)
    {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $tanggal = date('Y-m-d');
        // $tanggal = '2019-08-07';

        $wherepoli = "";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND A.idbppoli IN (" . implode(",", $filterpoli) . ") ";
		
        $now = DB::connection('mysql')->select("SELECT A.policaption AS bppoli, X.*
        	FROM munitkerjapoli A
        	LEFT JOIN ( 
        		SELECT A.idbppoli, COALESCE(A.servesno,0) AS noantrian, A.servesmax FROM munitkerjapolidaily A
					WHERE A.idunitkerja = $idunitkerja AND A.servesdate = '$tanggal'
			) X ON A.idbppoli = X.idbppoli
			WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = $idunitkerja $wherepoli ");

        $next = DB::connection('mysql')->select("SELECT A.policaption AS bppoli, X.*, 
            CASE WHEN X.noantrian = 1 THEN DATE_FORMAT(A.jambuka, '%H.%i') ELSE DATE_FORMAT(DATE_ADD(COALESCE(X.servestime,NOW()), INTERVAL A.avgtindakan SECOND), '%H.%i') END AS jamestimasi,
            ROUND((A.avgtindakan+30)/60) AS waktutindakan, ROUND((A.avgnontindakan+30)/60) AS waktunontindakan
        	FROM munitkerjapoli A
        	LEFT JOIN ( 
        		SELECT A.idbppoli, A.servesno + 1 AS noantrian, A.servesmax, A.servestime FROM munitkerjapolidaily A
					WHERE A.idunitkerja = $idunitkerja AND A.servesdate = '$tanggal'
			) X ON A.idbppoli = X.idbppoli
			WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = $idunitkerja $wherepoli ");

        $data = array("now" => $now, "next" => $next);

        return Response::json(array('data' => $data));
    }

    public function getNomorold(Request $request)
    {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $tanggal = date('Y-m-d');
        // $tanggal = '2019-08-07';

        $wherepoli = "";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND A.idbppoli IN (" . implode(",", $filterpoli) . ") ";
		
        $now = DB::connection('mysql')->select("SELECT A.policaption AS bppoli, X.*
            FROM munitkerjapoli A
            LEFT JOIN ( 
                SELECT A.idbppoli, COALESCE(B.pasiennoantrian,0) AS noantrian, DATE_FORMAT(B.tanggaleta, '%H.%i') AS jamestimasi, A.servesmax, B.NAMA_LGKP AS pasien FROM munitkerjapolidaily A
                    LEFT JOIN (
                        SELECT idunitkerja, idbppoli, pasiennoantrian, tanggaleta, NIK, NAMA_LGKP, tanggalbuka FROM mantrian WHERE idunitkerja = $idunitkerja AND DATE(tanggalbuka) = '$tanggal'
                        UNION
                        SELECT idunitkerja, idbppoli, pasiennoantrian, tanggaleta, NIK, NAMA_LGKP, tanggalbuka FROM mantrianserve WHERE idunitkerja = $idunitkerja AND DATE(tanggalbuka) = '$tanggal'
                    ) B ON A.idunitkerja = B.idunitkerja AND A.idbppoli = B.idbppoli AND A.servesno = B.pasiennoantrian AND A.servesdate = DATE(B.tanggalbuka)
                    WHERE A.idunitkerja = $idunitkerja AND A.servesdate = '$tanggal'
            ) X ON A.idbppoli = X.idbppoli
            WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = $idunitkerja $wherepoli ");

        $next = DB::connection('mysql')->select("SELECT A.policaption AS bppoli, X.*, 
            CASE WHEN X.noantrian = 1 THEN DATE_FORMAT(A.jambuka, '%H.%i') ELSE DATE_FORMAT(DATE_ADD(COALESCE(X.servestime,NOW()), INTERVAL A.avgtindakan SECOND), '%H.%i') END AS jamestimasi,
            ROUND((A.avgtindakan+30)/60) AS waktutindakan, ROUND((A.avgnontindakan+30)/60) AS waktunontindakan
            FROM munitkerjapoli A
            LEFT JOIN ( 
                SELECT A.idbppoli, B.pasiennoantrian AS noantrian, A.servesmax, A.servestime, B.NAMA_LGKP AS pasien FROM munitkerjapolidaily A
                    LEFT JOIN (
                        SELECT idunitkerja, idbppoli, pasiennoantrian, tanggaleta, NIK, NAMA_LGKP, tanggalbuka FROM mantrian WHERE idunitkerja = $idunitkerja AND DATE(tanggalbuka) = '$tanggal'
                        UNION
                        SELECT idunitkerja, idbppoli, pasiennoantrian, tanggaleta, NIK, NAMA_LGKP, tanggalbuka FROM mantrianserve WHERE idunitkerja = $idunitkerja AND DATE(tanggalbuka) = '$tanggal'
                    ) B ON A.idunitkerja = B.idunitkerja AND A.idbppoli = B.idbppoli AND (A.servesno+1) = B.pasiennoantrian AND A.servesdate = DATE(B.tanggalbuka)
                    WHERE A.idunitkerja = $idunitkerja AND A.servesdate = '$tanggal'
            ) X ON A.idbppoli = X.idbppoli
            WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = $idunitkerja $wherepoli ");

        $data = array("now" => $now, "next" => $next);

        return Response::json(array('data' => $data));
    }

    public function getDataPoli(Request $request, $idbppoli)
    {
        $tanggal = date('Y-m-d');
        // $tanggal = '2019-08-07';
		$idunitkerja = $request->get('idunitkerja');
        $data = DB::connection('mysql')->select("SELECT A.nama, COALESCE(X.servesno, 0) AS noantrian, COALESCE(X.NAMA_LGKP, '-') AS pasien, X.*
            FROM mbppoli A
            LEFT JOIN ( SELECT A.*, B.NAMA_LGKP FROM munitkerjapolidaily A
                LEFT JOIN (
                        SELECT idunitkerja, idbppoli, pasiennoantrian, tanggaleta, NIK, NAMA_LGKP, tanggalbuka FROM mantrian WHERE idunitkerja = $idunitkerja AND DATE(tanggalbuka) = '$tanggal'
                        UNION
                        SELECT idunitkerja, idbppoli, pasiennoantrian, tanggaleta, NIK, NAMA_LGKP, tanggalbuka FROM mantrianserve WHERE idunitkerja = $idunitkerja AND DATE(tanggalbuka) = '$tanggal'
                    ) B ON A.idunitkerja = B.idunitkerja AND A.idbppoli = B.idbppoli AND A.servesno = B.pasiennoantrian 
                WHERE A.idunitkerja = $idunitkerja AND A.idbppoli = $idbppoli AND A.servesdate = '$tanggal'
            ) X ON A.noid = X.idbppoli
            WHERE A.noid = $idbppoli");
            
        return Response::json(array('data' => $data));
    }
	
	public function getDokter(Request $request)
    {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        
        $tanggal = date('Y-m-d');
        // $tanggal = '2019-08-07';

        $wherepoli = "";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND A.idbppoli IN (" . implode(",", $filterpoli) . ") ";
        $dokter = DB::connection('mysql')->select("SELECT A.policaption AS bppoli, B.*, C.nama AS namapoli
        	FROM munitkerjapoli A
            LEFT JOIN mdokter B ON A.idunitkerja = B.idunitkerja
            LEFT JOIN mbppoli C ON C.noid = A.idbppoli
			WHERE A.idbppoli=B.idbppoli AND B.isdokter = 1 AND A.idunitkerja = $idunitkerja $wherepoli ");

        $data = array("dokter" => $dokter);
        
        return Response::json(array('data' => $data));
    }

    public function getListPasien(Request $request)
    {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $tanggalawal = date('Y-m-d');
		$tanggalakhir = date('Y-m-d', strtotime('+1 day', strtotime($tanggalawal)));
        // $tanggal = '2022-05-12';
		
        $wherepoli = "";
        $limit ="";
		$wheretanggal = "AND A.tanggaleta >= '{$tanggalawal} 00:00:00' AND A.tanggaleta < '{$tanggalakhir} 00:00:00'";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND A.idbppoli IN (" . implode(",", $filterpoli) . ") ";
        if ($limit = $request->input('limit')) $limit = " LIMIT {$limit} ";
        if ($where = $request->input('where')) $wherepoli = $wherepoli." ".$where;
		
        $pasien = DB::connection('mysql')->select("SELECT A.pasiennoantrian, A.NAMA_LGKP, A.tanggaleta, A.iscall, A.isrecall, A.isconfirm, A.isserved, A.isskipped, A.isconsul, A.isdone, A.idbppoli, A.idbppoliasal, P.nama as poli, P2.nama as poliasal
			FROM mantrian A
            INNER JOIN mbppoli P ON P.noid = A.idbppoli
            INNER JOIN mbppoli P2 ON P2.noid = A.idbppoliasal
			WHERE A.idunitkerja = {$idunitkerja} {$wherepoli} {$wheretanggal} AND A.pasiennoantrian>0 GROUP BY A.pasiennoantrian ORDER BY A.idbppoli, A.pasiennoantrian {$limit}");
            
        $data = array("listpasien" => $pasien);
        
        return Response::json(array('data' => $data));
    }
	
    public function getPasienPoli(Request $request)
    {
        $tanggal = date('Y-m-d');
        // $tanggal = '2019-08-07';
        $idunitkerja = $request->input('idunitkerja');
        $idbppoli = $request->input('idbppoli');
        $idpolireq = $request->input('idpolireq');
        $isconfirm = $request->input('isconfirm');

        $noantrian = 0;

        if ($idbppoli == 0) {
            $wherepoli = "";
        } else {
            $wherepoli = " AND idbppoli = " . $idbppoli . " ";
        }
        
        if($isconfirm == 0) {
            $whereisconfirm = " AND isconfirm = 0";
        }else {
            $whereisconfirm = "";
        }

        // if ($idpolireq == 0 || $idpolireq == 31 || $idpolireq == 39) {
        if ($idpolireq === 0) {
            $wherehistory = " AND (pasiennoantrian, idbppoli) NOT IN (SELECT pasiennoantrian, idbppoliasal FROM historypasien WHERE idunitkerja = $idunitkerja AND DATE(tanggaleta) = '$tanggal' AND idbppoli = $idpolireq) ";
        } elseif ($idpolireq == 31 || $idpolireq == 39) {
            $wherehistory = " AND (pasiennoantrian, idbppoli) IN (SELECT pasiennoantrian, idbppoliasal FROM historypasien WHERE idunitkerja = $idunitkerja AND DATE(tanggaleta) = '$tanggal' AND idbppoli = $idpolireq AND tipe = 0) AND (pasiennoantrian, idbppoli) NOT IN (SELECT pasiennoantrian, idbppoliasal FROM historypasien WHERE idunitkerja = $idunitkerja AND DATE(tanggaleta) = '$tanggal' AND idbppoli = $idpolireq AND tipe = 1) ";
        } elseif ($idpolireq == 9999) {
            $wherehistory = "";
        } else {
            $wherehistory = "";
            $cekantrian = DB::select("SELECT COALESCE(servesno, 0) AS noantrian FROM munitkerjapolidaily WHERE idunitkerja = $idunitkerja $wherepoli AND servesdate = '$tanggal' LIMIT 1");
            if ($cekantrian) {
                $noantrian = $cekantrian[0]->noantrian;
            }
        }

		
        $data = DB::connection('mysql')->select("SELECT A.noid, idunitkerja, idbppoli, B.nama AS bppoli, pasiennoantrian, tanggaleta, DATE_FORMAT(tanggaleta, '%Y-%m-%d') AS tanggallayanan, DATE_FORMAT(tanggaleta, '%H.%i') AS jamestimasi, NIK, NAMA_LGKP  FROM mantrian A LEFT JOIN mbppoli B ON A.idbppoli = B.noid WHERE idunitkerja = $idunitkerja $wherepoli $whereisconfirm AND DATE(tanggalbuka) = '$tanggal' AND pasiennoantrian > $noantrian $wherehistory
            UNION
            SELECT A.noid, idunitkerja, idbppoli,  B.nama AS bppoli, pasiennoantrian, tanggaleta, DATE_FORMAT(tanggaleta, '%Y-%m-%d') AS tanggallayanan, DATE_FORMAT(tanggaleta, '%H.%i') AS jamestimasi, NIK, NAMA_LGKP FROM mantrianserve A LEFT JOIN mbppoli B ON A.idbppoli = B.noid WHERE idunitkerja = $idunitkerja $wherepoli AND DATE(tanggalbuka) = '$tanggal' AND pasiennoantrian > $noantrian $wherehistory ORDER BY pasiennoantrian ");
        
        return Response::json(array('data' => $data));
    }

    private function getCurrentTotalNomorAntrian($input){
        $tanggal     = date('Y-m-d');
        $idunitkerja = $input['idunitkerja'];
        $noantrian   = $input['pasiennoantrian'];
        $idbppoli    = $input['idbppoli'];

        $res = DB::connection('mysql')->table('munitkerjapolidaily')
            ->where('idunitkerja', $idunitkerja)
            ->where('idbppoli', $idbppoli)
            ->where('servesdate', $tanggal)
            ->first();
        $total = isset($res) ? $res->servesdate : 0;
        return $total;
    }
    
    public function layaniantrian(Request $request)
    {
        $currentnomor = $this->getCurrentTotalNomorAntrian($request->all());
        $data = array_merge( $request->all() , ['currentnomor'=>$currentnomor]);

        $res = Http::post(config('app.hostapi')."/api/layaniantrian2", $data);
        $statusCode = $res->getStatusCode();
        $data = json_decode($res->getBody(), true);

        DB::beginTransaction();
        try {
            if($statusCode != 200){
                return response()->json($data, $statusCode);
            }
            DB::connection('mysql')->table('munitkerjapolidaily')
                ->updateOrCreate( ['noid'=> $data['munitkerjapolidaily']['noid']], $data['munitkerjapolidaily']);
            // foreach ($data['pasien'] as $px) {
            //     DB::connection('mysql')->table('mpasien')->updateOrInsert( ["noid" => $px['noid']], $px );
            // }
            // foreach ($data['mantrian'] as $px) {
            //     DB::connection('mysql')->table('mpasien')->updateOrInsert( ["noid" => $px['noid']], $px );
            // }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $idreturn = $e->getMessage();
            return response()->json(["statusText"=>$idreturn], 400);
        }
        return response()->json("Berhasil memanggil A", $statusCode);
    }

    public function goToFarmasiLab(Request $request)
    {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $pasiennoantrian = $request->input('pasiennoantrian');
        $idbppoli = $request->input('poli');
        $tipe = $request->input('tipe');
        $tanggal = date('Y-m-d');
        
        if($tipe=='FARMASI'){
            $idbppoli_baru= 31;
        }else if($tipe=='LAB'){
            $idbppoli_baru = 39;
        }else{
            return response()->json(['message' => 'Not Found!'], 404);
        }

        DB::enableQueryLog();
        DB::beginTransaction();
        try {
            $antrian = DB::table('mantrian')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$pasiennoantrian )
                ->whereIn('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->first();

            if ($antrian) {
                $hasAntrianLamaInPoliBaru = DB::table('mantrian')
                    ->where('idunitkerja', $idunitkerja)
                    // ->where('pasiennoantrian',$pasiennoantrian )         // pasien no antrian belum diketemukan, 
                    ->where('NAMA_LGKP', $antrian->NAMA_LGKP)               // alternatif pakai NAMA_LGKP
                    ->where('idbppoli',$idbppoli_baru)
                    ->whereDate('tanggaleta', '=', $tanggal)
                    ->first();
                
                if (!$hasAntrianLamaInPoliBaru) {
                    $params=[
                        $antrian->iddevice,
                        $antrian->idtypepasien,
                        $antrian->kodekartu,
                        $antrian->pasienkode,
                        $antrian->idunitkerja,
                        $idbppoli_baru,
                        $antrian->idunitkerjaasal,
                        $idbppoli[0],
                        $tanggal,
                        $antrian->NO_KK,
                        $antrian->RFID,
                        $antrian->NIK,
                        $antrian->NAMA_LGKP,
                        $antrian->JENIS_KELAMIN,
                        $antrian->TMPT_LHR,
                        $antrian->TGL_LAHIR,
                        $antrian->AGAMA,
                        $antrian->STATUS_KWIN,
                        $antrian->HUB_KELUARGA,
                        $antrian->PENDIDIKAN,
                        $antrian->PEKERJAAN,
                        $antrian->GOL_GARAH,
                        $antrian->BER_AKTA_LAHIR,
                        $antrian->TGL_PJG_KTP,
                        $antrian->NO_KEL,
                        $antrian->NAMA_KEL,
                        $antrian->NO_KEC,
                        $antrian->NAMA_KEC,
                        $antrian->NO_KAB,
                        $antrian->NAMA_KAB,
                        $antrian->NO_PROP,
                        $antrian->NAMA_PROP,
                        $antrian->ALAMAT,
                        $antrian->NO_RT,
                        $antrian->NO_RW,
                        $antrian->GAKIN,
                        $antrian->KATEGORI_GAKIN,
                        $antrian->LUAR_SBY,
                        $antrian->NO_TLP,
                        $antrian->NIKSIMDUK,
                        $antrian->statusnik,
                    ];

                    DB::select('call antrian_add(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', $params);
                }

                // UPDATE FLAGS ANTRIAN BARU 
                DB::table('mantrian')
                    ->where('idunitkerja', $idunitkerja)
                    // ->where('pasiennoantrian',$pasiennoantrian )         // pasien no antrian belum diketemukan, 
                    ->where('NAMA_LGKP', $antrian->NAMA_LGKP)               // alternatif pakai NAMA_LGKP
                    ->where('idbppoli',$idbppoli_baru)
                    ->whereDate('tanggaleta', '=', $tanggal)
                    ->update([
                        'isconfirm' => 1,
                        'doconfirm' => date('Y-m-d H:i:s'),
                        'isdone' => 0,
                        'isrecall' => 0,
                    ]);

                $idreturn = 1;
            } else {
                throw new Exception("Data antrean tidak ditemukan");
            }

             //DONE
             DB::table('mantrian')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$pasiennoantrian )
                ->where('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->update([
                    'isdone' => 1,
                    "dodone" => date('Y-m-d H:i:s')
                ]); 
        } catch (Exception $e) {
            DB::rollback();
            $idreturn = $e->getMessage();
            return response()->json(["statusText"=>$idreturn], 400);
        }
        DB::commit();
        return $idreturn;
    }

    public function goToPoliRujukan(Request $request)
    {
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $pasiennoantrian = $request->input('pasiennoantrian');
        $idbppoli = $request->input('poli');
        $idbppoli_baru = $request->input('polirujukan');
        $tipe = $request->input('tipe');
        $tanggal = date('Y-m-d');
        
        DB::enableQueryLog();
        DB::beginTransaction();
        try {
            $antrian = DB::table('mantrian')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$pasiennoantrian )
                ->whereIn('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->first();

            if ($antrian) {
                $hasAntrianLamaInPoliBaru = DB::table('mantrian')
                    ->where('idunitkerja', $idunitkerja)
                    // ->where('pasiennoantrian',$pasiennoantrian )         // pasien no antrian belum diketemukan, 
                    ->where('NAMA_LGKP', $antrian->NAMA_LGKP)               // alternatif pakai NAMA_LGKP
                    ->where('idbppoli',$idbppoli_baru)
                    ->whereDate('tanggaleta', '=', $tanggal)
                    ->first();

                //AVOID TO CREATE NEW ANTRIAN IF FIND ANY
                if(!$hasAntrianLamaInPoliBaru){
                    $params=[
                        $antrian->iddevice,
                        $antrian->idtypepasien,
                        $antrian->kodekartu,
                        $antrian->pasienkode,
                        $antrian->idunitkerja,
                        $idbppoli_baru,
                        $antrian->idunitkerjaasal,
                        $idbppoli[0],
                        $tanggal,
                        $antrian->NO_KK,
                        $antrian->RFID,
                        $antrian->NIK,
                        $antrian->NAMA_LGKP,
                        $antrian->JENIS_KELAMIN,
                        $antrian->TMPT_LHR,
                        $antrian->TGL_LAHIR,
                        $antrian->AGAMA,
                        $antrian->STATUS_KWIN,
                        $antrian->HUB_KELUARGA,
                        $antrian->PENDIDIKAN,
                        $antrian->PEKERJAAN,
                        $antrian->GOL_GARAH,
                        $antrian->BER_AKTA_LAHIR,
                        $antrian->TGL_PJG_KTP,
                        $antrian->NO_KEL,
                        $antrian->NAMA_KEL,
                        $antrian->NO_KEC,
                        $antrian->NAMA_KEC,
                        $antrian->NO_KAB,
                        $antrian->NAMA_KAB,
                        $antrian->NO_PROP,
                        $antrian->NAMA_PROP,
                        $antrian->ALAMAT,
                        $antrian->NO_RT,
                        $antrian->NO_RW,
                        $antrian->GAKIN,
                        $antrian->KATEGORI_GAKIN,
                        $antrian->LUAR_SBY,
                        $antrian->NO_TLP,
                        $antrian->NIKSIMDUK,
                        $antrian->statusnik,
                    ];
    
                    DB::select('call antrian_add(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', $params);
                }

                // UPDATE ANTRIAN RUJUKAN/KONSUL
                DB::table('mantrian')
                    ->where('idunitkerja', $idunitkerja)
                    // ->where('pasiennoantrian',$pasiennoantrian )         // pasien no antrian belum diketemukan, 
                    ->where('NAMA_LGKP', $antrian->NAMA_LGKP)               // alternatif pakai NAMA_LGKP
                    ->where('idbppoli',$idbppoli_baru)
                    ->whereDate('tanggaleta', '=', $tanggal)
                    ->update([
                        'isconsul' => 1,
                        'doconsul' => date('Y-m-d H:i:s'),
                        'isconfirm' => 1,
                        'doconfirm' => date('Y-m-d H:i:s'),
                        'isdone' => 0,
                        'isrecall' => 0,
                    ]);

                $idreturn = 1;
            } else {
                throw new Exception("Data antrean tidak ditemukan");
            }
            
            //DONE
            DB::table('mantrian')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$pasiennoantrian )
                ->where('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->update([
                    'isdone' => 1,
                    "dodone" => date('Y-m-d H:i:s')
                ]);
        } catch (Exception $e) {
            DB::rollback();
            $idreturn = $e->getMessage();
        }
        DB::commit();
        return $idreturn;
    }

    public function layanikembali(Request $request)
    {
        $noantrian = $request->input('pasiennoantrian');
        $idbppoli = $request->input('poli');
		
        DB::enableQueryLog();
        DB::beginTransaction();
        $idreturn = '';
        try {
            $tanggal     = date('Y-m-d');
            // $idunitkerja = Auth::user()->idunitkerja;
            $idunitkerja = $request->get('idunitkerja');
            
            $antrian = DB::table('mantrian')->select('pasiennoantrian','pasienid','tanggaleta','NAMA_LGKP')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$noantrian)
                ->whereIn('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->first();

            if ($antrian) {
                $dt = [
                    "tanggal" => $tanggal,
                    "idbppoli" => $idbppoli,
                    "idunitkerja" => $idunitkerja,
                    "pasiennoantrian" => $noantrian,
                    "text" => $antrian->NAMA_LGKP,
                ];

                $addantriansuara = $this->addAntrianSuara(new Request($dt));

                // UPDATE STATUS RECALL ANTRIAN
                DB::table('mantrian')
                    ->where('idunitkerja', $idunitkerja)
                    ->where('pasiennoantrian',$noantrian )
                    ->where('idbppoli',$idbppoli)
                    ->whereDate('tanggaleta', '=', $tanggal)
                    ->update([
                        'isrecall' => 1,
                        'dorecall' => date('Y-m-d H:i:s'),
                        'isdone' => 0,
                        'dodone' => date('Y-m-d H:i:s'),
                    ]);

                $idreturn = 1;
            } else {
                throw new Exception("Antrian selanjutnya tidak ditemukan");
            }
        } catch (Exception $e) {
            DB::rollback();
            $idreturn = $e->getMessage();
            return response()->json(['statusText'=>$idreturn], 401);
        }
        DB::commit();

        return $idreturn;
    }

    public function addhistory($tipe, Request $request)
    {
		
        $noid = $request->input('noid');
        $tanggal = $request->input('tanggal');
        $idbppoli = $request->input('idbppoli');
        $idunitkerja = $request->input('idunitkerja');
        $noantrian = $request->input('pasiennoantrian');

        $dataantrian = DB::select("SELECT A.noid, idunitkerja, idbppoli, B.nama AS bppoli, pasiennoantrian, tanggaleta, DATE_FORMAT(tanggaleta, '%Y-%m-%d') AS tanggallayanan, DATE_FORMAT(tanggaleta, '%H.%i') AS jamestimasi, NIK, NAMA_LGKP, ALAMAT, pasienantriancode  FROM mantrian A LEFT JOIN mbppoli B ON A.idbppoli = B.noid WHERE idunitkerja = $idunitkerja AND idbppoli = $idbppoli AND DATE(tanggaleta) = '$tanggal' AND pasiennoantrian = $noantrian
            UNION
            SELECT A.noid, idunitkerja, idbppoli,  B.nama AS bppoli, pasiennoantrian, tanggaleta, DATE_FORMAT(tanggaleta, '%Y-%m-%d') AS tanggallayanan, DATE_FORMAT(tanggaleta, '%H.%i') AS jamestimasi, NIK, NAMA_LGKP, ALAMAT, pasienantriancode FROM mantrianserve A LEFT JOIN mbppoli B ON A.idbppoli = B.noid WHERE idunitkerja = $idunitkerja AND idbppoli = $idbppoli AND DATE(tanggaleta) = '$tanggal'  AND pasiennoantrian = $noantrian
            ORDER BY pasiennoantrian ");

        $datapasien = array(
            // "idunitkerja" => $dataantrian[0]->idunitkerja,
            // "idbppoli" => $dataantrian[0]->idbppoli,
            "nik" => $dataantrian[0]->NIK,
            "nama" => $dataantrian[0]->NAMA_LGKP,
            "alamat" => $dataantrian[0]->ALAMAT,
            "tanggaleta" => $dataantrian[0]->tanggaleta,
            "pasiennoantrian" => $dataantrian[0]->pasiennoantrian,
            "pasienantriancode" => $dataantrian[0]->pasienantriancode,
        );

        if ($tipe == 1) { //loket
            $dt = array(
                "idunitkerja" => $dataantrian[0]->idunitkerja,
                "idbppoli" => 0,
                "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                "idbppoliasal" => $dataantrian[0]->idbppoli,
                "tanggal" => date('Y-m-d H:i:s')
            );

            DB::table("historypasien")->insert(array_merge($dt, $datapasien));
        } elseif ($tipe == 2) { //poli
            $dt = array(
                "idunitkerja" => $dataantrian[0]->idunitkerja,
                "idbppoli" => $dataantrian[0]->idbppoli,
                "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                "idbppoliasal" => $dataantrian[0]->idbppoli,
                "tanggal" => date('Y-m-d H:i:s')
            );

            DB::table("historypasien")->insert(array_merge($dt, $datapasien));
        } elseif ($tipe == 3) { //kasir
            $idtujuan = $request->input('idtujuan');
            if ($idtujuan == 0) {
                $dt = array(
                    "idunitkerja" => $dataantrian[0]->idunitkerja,
                    "idbppoli" => 99999,
                    "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                    "idbppoliasal" => $dataantrian[0]->idbppoli,
                    "tanggal" => date('Y-m-d H:i:s')
                );

                DB::table("historypasien")->insert(array_merge($dt, $datapasien));
            } else {
                $dt = array(
                    "idunitkerja" => $dataantrian[0]->idunitkerja,
                    "idbppoli" => 99999,
                    "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                    "idbppoliasal" => $dataantrian[0]->idbppoli,
                    "tanggal" => date('Y-m-d H:i:s')
                );

                DB::table("historypasien")->insert(array_merge($dt, $datapasien));

                $dt = array(
                    "idunitkerja" => $dataantrian[0]->idunitkerja,
                    "idbppoli" => $idtujuan,
                    "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                    "idbppoliasal" => $dataantrian[0]->idbppoli,
                    "tanggal" => date('Y-m-d H:i:s')
                );

                DB::table("historypasien")->insert(array_merge($dt, $datapasien));
            }
        } elseif ($tipe == 4) { //aplab
            $idasal = $request->input('idasal');
            $dt = array(
                "idunitkerja" => $dataantrian[0]->idunitkerja,
                "idbppoli" => $idasal,
                "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                "idbppoliasal" => $dataantrian[0]->idbppoli,
                "tanggal" => date('Y-m-d H:i:s'),
                "tipe" => 1,
            );

            DB::table("historypasien")->insert(array_merge($dt, $datapasien));
        }

        return 1;
    }

    public function getriwayat(Request $request)
    {
		
        $tanggal = $request->input('tanggal');
        $idbppoli = $request->input('idbppoli');
        $idunitkerja = $request->input('idunitkerja');
        $noantrian = $request->input('pasiennoantrian');

        $data = DB::select("SELECT A.id, idunitkerja, idbppoli, CASE WHEN idbppoli = 99999 THEN 'KASIR' ELSE B.nama END AS bppoli, pasiennoantrian, tanggaleta, DATE_FORMAT(tanggaleta, '%Y-%m-%d') AS tanggallayanan, DATE_FORMAT(tanggal, '%H.%i') AS jam, nik, A.nama, alamat, pasienantriancode  FROM historypasien A LEFT JOIN mbppoli B ON A.idbppoli = B.noid WHERE idunitkerjaasal = $idunitkerja AND idbppoliasal = $idbppoli AND DATE(tanggaleta) = '$tanggal' AND pasiennoantrian = $noantrian
            ORDER BY tanggal ");

        return Response::json(array('data' => $data));
    }

    public function getrekappoli(Request $request)
    {
		
        $idunitkerja = $request->get('idunitkerja');
        $tanggal = date('Y-m-d');
        // $tanggal = '2019-08-07';
        $data = DB::select("SELECT 'all' AS idbppoli, COALESCE(SUM(servesmax),0) AS jumlahantrian FROM munitkerjapolidaily WHERE idunitkerja = '$idunitkerja' AND servesdate = '$tanggal'
            UNION
            SELECT idbppoli, SUM(servesmax) AS jumlahantrian FROM munitkerjapolidaily WHERE idunitkerja = '$idunitkerja' AND servesdate = '$tanggal' GROUP BY idbppoli");

        return Response::json(array('data' => $data));
    }

    public function getPanggilanAntrian(Request $request)
    {
        $tanggal = date('Y-m-d');
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $filterpoli = $request->input('poli');
		
        $data = DB::table('panggilanantrian')
            ->leftJoin('mbppoli', 'panggilanantrian.idbppoli', '=', 'mbppoli.noid')
            ->where('idunitkerja', $idunitkerja)
            ->where('iscall', 0)
            ->where('tanggal', $tanggal)
            ->when($filterpoli, function ($query) use ($filterpoli) {
                return $query->whereIn('idbppoli', $filterpoli);
            })
            ->select('panggilanantrian.*', 'mbppoli.nama AS namapoli')
            ->orderBy('id')
            ->first();
        return Response::json(array('data' => $data));
    }

    public function addAntrianSuara(Request $request)
    {
		
        $tanggal = date('Y-m-d');
        $idbppoli = $request->input('idbppoli');
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = $request->get('idunitkerja');
        $noantrian = $request->input('pasiennoantrian');
        try {
            $dt = ["idunitkerja" => $idunitkerja,
                'idbppoli' => $idbppoli,
                'noantrian' => $noantrian,
                'tanggal' => $tanggal,
                'text' => $request->input('text')
            ];
            DB::table('panggilanantrian')->insert($dt);
            return "ok";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deletePanggilanAntrian($id)
    {
		
        DB::table('panggilanantrian')->where('id', $id)->delete();
        // DB::table('panggilanantrian')->where('id', $id)->update(array("iscall" => 1));
    }

    public function getDataUnitkerja(Request $request)
    {
		
        $idunitkerja = $request->input('idunitkerja');
        $data = DB::table('munitkerja')->where('noid', $idunitkerja)->first();
        return Response::json(array('data' => $data));
    }
}
