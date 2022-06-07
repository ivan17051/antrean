<?php

namespace App\Http\Controllers\API;

use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
use DateTime, DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use DBOnTheFly;
use App\Http\Controllers\Controller;

class Antrian extends Controller
{
    private function getLatestListAntrianPoli($tanggal, $idunitkerja, $idbppoli, $currentnomor=1000){
        $res['munitkerjapolidaily'] = DBOnTheFly::setConnection($idunitkerja)->table('munitkerjapolidaily')
            ->where('idunitkerja', $idunitkerja)
            ->where('idbppoli', $idbppoli)
            ->where('servesdate', $tanggal)
            ->take(1)->first();
        $res['statusantrian'] = DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
            ->select("noid","isexpired","iscall","isrecall","isconfirm","isserved","isskipped","isconsul","isdone","pasiennoantrian")
            ->where('idunitkerja', $idunitkerja)
            ->where('idbppoli',$idbppoli)
            ->whereDate('tanggaleta', '=', $tanggal)->get();
        $res['mantrian'] = DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
            ->where('idunitkerja', $idunitkerja)
            ->where('idbppoli',$idbppoli)
            ->whereDate('tanggaleta', '=', $tanggal)
            ->where('pasiennoantrian','>',$currentnomor)->get();

        $idpasien = collect($res['mantrian'])->pluck('pasienid');
        $res['pasien']=DBOnTheFly::setConnection($idunitkerja)->table('mpasien')->whereIn('noid',$idpasien)->get();
        return $res;
    }

    public function getantrianpoli(Request $request){
        //ask for sync
        $tanggal     = date('Y-m-d');
        $idunitkerja = $request->input('idunitkerja');
        $idbppoli    = $request->input('idbppoli');
        $currentnomor = $request->input('currentnomor');
        $res = $this->getLatestListAntrianPoli($tanggal, $idunitkerja, $idbppoli, $currentnomor);
        return response()->json($res, 200);
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
		
        $now = DBOnTheFly::setConnection($idunitkerja)->select("SELECT A.policaption AS bppoli, X.*
        	FROM munitkerjapoli A
        	LEFT JOIN ( 
        		SELECT A.idbppoli, COALESCE(A.servesno,0) AS noantrian, A.servesmax FROM munitkerjapolidaily A
					WHERE A.idunitkerja = $idunitkerja AND A.servesdate = '$tanggal'
			) X ON A.idbppoli = X.idbppoli
			WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = $idunitkerja $wherepoli ");

        $next = DBOnTheFly::setConnection($idunitkerja)->select("SELECT A.policaption AS bppoli, X.*, 
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
		
        $pasien = DBOnTheFly::setConnection($idunitkerja)->select("SELECT A.pasiennoantrian, A.NAMA_LGKP, A.tanggaleta, A.iscall, A.isrecall, A.isconfirm, A.isserved, A.isskipped, A.isconsul, A.isdone, A.idbppoli, A.idbppoliasal, P.nama as poli, P2.nama as poliasal
			FROM mantrian A
            INNER JOIN mbppoli P ON P.noid = A.idbppoli
            INNER JOIN mbppoli P2 ON P2.noid = A.idbppoliasal
			WHERE A.idunitkerja = {$idunitkerja} {$wherepoli} {$wheretanggal} AND A.pasiennoantrian>0 GROUP BY A.pasiennoantrian ORDER BY A.idbppoli, A.pasiennoantrian {$limit}");
            
        $data = array("listpasien" => $pasien);
        
        return Response::json(array('data' => $data));
    }
    
    public function layaniantrian(Request $request)
    {
        DB::enableQueryLog();
        DB::beginTransaction();
        $idreturn = '';
        try {
            $tanggal     = date('Y-m-d');
            // $tanggal = '2019-08-07';
            // $idunitkerja = Auth::user()->idunitkerja; //Input::get('idunitkerja');
            $idunitkerja = $request->input('idunitkerja');
            $noantrian   = $request->input('pasiennoantrian');
            $idbppoli    = $request->input('idbppoli');
            $tipe = $request->input('tipe');


            $res = DBOnTheFly::setConnection($idunitkerja)->table('munitkerjapolidaily')
                ->where('idunitkerja', $idunitkerja)
                ->where('idbppoli', $idbppoli)
                ->where('servesdate', $tanggal)
                ->take(1)->first();

            if ($res) {
                $CALLNEXT = false;
                
                if($tipe == 1) {
                    //DONE
                    DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
                    ->where('idunitkerja', $idunitkerja)
                    ->where('pasiennoantrian',$noantrian )
                    ->where('idbppoli',$idbppoli)
                    ->whereDate('tanggaleta', '=', $tanggal)
                    ->update([
                        'isdone' => 1,
                        "dodone" => date('Y-m-d H:i:s')
                    ]);

                }else if($tipe == 2){
                    $CALLNEXT = true;

                    //SKIPPED
                    DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
                    ->where('idunitkerja', $idunitkerja)
                    ->where('pasiennoantrian',$noantrian )
                    ->where('idbppoli',$idbppoli)
                    ->whereDate('tanggaleta', '=', $tanggal)
                    ->where('isdone',0)
                    ->update([
                        'isskipped' => 1,
                        "doskipped" => date('Y-m-d H:i:s')
                    ]);
                }else{
                    $CALLNEXT = true;
                }

                if($CALLNEXT){
                    if ($res->servesno + 1 > $res->servesmax) {
                        throw new Exception("Semua Antrian Sudah Dilayani");
                    }

                    DBOnTheFly::setConnection($idunitkerja)->table('munitkerjapolidaily')
                        ->where('noid', $res->noid)
                        ->update([
                            'servesno' => $res->servesno + 1,
                            "servestime" => date('Y-m-d H:i:s')
                        ]);

                    $nomor = $res->servesno + 1;
                    $data = DBOnTheFly::setConnection($idunitkerja)->select("SELECT NIK, NAMA_LGKP AS nama FROM mantrian WHERE idunitkerja = $idunitkerja AND idbppoli = $idbppoli AND DATE(tanggalbuka) = '$tanggal' AND pasiennoantrian = $nomor LIMIT 1 ");

                    $dt = [
                        "tanggal" => $tanggal,
                        "idbppoli" => $idbppoli,
                        "idunitkerja" => $idunitkerja,
                        "pasiennoantrian" => $res->servesno + 1,
                    ];

                    if ($data) {
                        $dt["text"] = $data[0]->nama;
                    }

                    $addantriansuara = $this->addAntrianSuara(new Request($dt));
                    
                    //SET IS CALL ANTRIAN BARU NYA
                    DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
                    ->where('idunitkerja', $idunitkerja)
                    ->where('pasiennoantrian',$res->servesno + 1 )
                    ->where('idbppoli',$idbppoli)
                    ->whereDate('tanggaleta', '=', $tanggal)
                    ->update([
                        'iscall' => 1,
                        "docall" => date('Y-m-d H:i:s')
                    ]);

                    $dthistory = array(
                        "noid" => $res->noid,
                        "tanggal" => $tanggal,
                        "idbppoli" => $idbppoli,
                        "idunitkerja" => $idunitkerja,
                        "pasiennoantrian" => $res->servesno + 1,
                    );
                    $addhistory = $this->addhistory(2, new Request($dthistory));
                }

                $idreturn = 1;

                //ask for sync
                $currentnomor = $request->input('currentnomor');
                $res = $this->getLatestListAntrianPoli($tanggal, $idunitkerja, $idbppoli, $currentnomor);
                return response()->json($res, 200);
            } else {
                throw new Exception("Antrian selanjutnya tidak ditemukan");
            }
        } catch (Exception $e) {
            DB::rollback();
            $idreturn = $e->getMessage();
            return response()->json(["statusText"=>$idreturn], 400);
        }
        DB::commit();

        return $idreturn;
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
            $antrian = DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$pasiennoantrian )
                ->whereIn('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->first();

            if ($antrian) {
                $hasAntrianLamaInPoliBaru = DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
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

                    DBOnTheFly::setConnection($idunitkerja)->select('call antrian_add(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', $params);
                }

                // UPDATE FLAGS ANTRIAN BARU 
                DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
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
             DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$pasiennoantrian )
                ->where('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->update([
                    'isdone' => 1,
                    "dodone" => date('Y-m-d H:i:s')
                ]); 

            //ask for sync
            $currentnomor = $request->input('currentnomor');
            $res = $this->getLatestListAntrianPoli($tanggal, $idunitkerja, $idbppoli, $currentnomor);
            return response()->json($res, 200);
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
            $antrian = DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$pasiennoantrian )
                ->whereIn('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->first();

            if ($antrian) {
                $hasAntrianLamaInPoliBaru = DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
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
    
                    DBOnTheFly::setConnection($idunitkerja)->select('call antrian_add(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', $params);
                }

                // UPDATE ANTRIAN RUJUKAN/KONSUL
                DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
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
            DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
                ->where('idunitkerja', $idunitkerja)
                ->where('pasiennoantrian',$pasiennoantrian )
                ->where('idbppoli',$idbppoli)
                ->whereDate('tanggaleta', '=', $tanggal)
                ->update([
                    'isdone' => 1,
                    "dodone" => date('Y-m-d H:i:s')
            ]);

            //ask for sync
            $currentnomor = $request->input('currentnomor');
            $res = $this->getLatestListAntrianPoli($tanggal, $idunitkerja, $idbppoli, $currentnomor);
            return response()->json($res, 200);
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
            
            $antrian = DBOnTheFly::setConnection($idunitkerja)->table('mantrian')->select('pasiennoantrian','pasienid','tanggaleta','NAMA_LGKP')
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
                DBOnTheFly::setConnection($idunitkerja)->table('mantrian')
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

            //ask for sync
            $currentnomor = $request->input('currentnomor');
            $res = $this->getLatestListAntrianPoli($tanggal, $idunitkerja, $idbppoli, $currentnomor);
            return response()->json($res, 200);
        } catch (Exception $e) {
            DB::rollback();
            $idreturn = $e->getMessage();
            return response()->json(['statusText'=>$idreturn], 401);
        }
        DB::commit();

        return $idreturn;
    }

    private function addhistory($tipe, Request $request)
    {
		
        $noid = $request->input('noid');
        $tanggal = $request->input('tanggal');
        $idbppoli = $request->input('idbppoli');
        $idunitkerja = $request->input('idunitkerja');
        $noantrian = $request->input('pasiennoantrian');

        $dataantrian = DBOnTheFly::setConnection($idunitkerja)->select("SELECT A.noid, idunitkerja, idbppoli, B.nama AS bppoli, pasiennoantrian, tanggaleta, DATE_FORMAT(tanggaleta, '%Y-%m-%d') AS tanggallayanan, DATE_FORMAT(tanggaleta, '%H.%i') AS jamestimasi, NIK, NAMA_LGKP, ALAMAT, pasienantriancode  FROM mantrian A LEFT JOIN mbppoli B ON A.idbppoli = B.noid WHERE idunitkerja = $idunitkerja AND idbppoli = $idbppoli AND DATE(tanggaleta) = '$tanggal' AND pasiennoantrian = $noantrian
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

            DBOnTheFly::setConnection($idunitkerja)->table("historypasien")->insert(array_merge($dt, $datapasien));
        } elseif ($tipe == 2) { //poli
            $dt = array(
                "idunitkerja" => $dataantrian[0]->idunitkerja,
                "idbppoli" => $dataantrian[0]->idbppoli,
                "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                "idbppoliasal" => $dataantrian[0]->idbppoli,
                "tanggal" => date('Y-m-d H:i:s')
            );

            DBOnTheFly::setConnection($idunitkerja)->table("historypasien")->insert(array_merge($dt, $datapasien));
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

                DBOnTheFly::setConnection($idunitkerja)->table("historypasien")->insert(array_merge($dt, $datapasien));
            } else {
                $dt = array(
                    "idunitkerja" => $dataantrian[0]->idunitkerja,
                    "idbppoli" => 99999,
                    "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                    "idbppoliasal" => $dataantrian[0]->idbppoli,
                    "tanggal" => date('Y-m-d H:i:s')
                );

                DBOnTheFly::setConnection($idunitkerja)->table("historypasien")->insert(array_merge($dt, $datapasien));

                $dt = array(
                    "idunitkerja" => $dataantrian[0]->idunitkerja,
                    "idbppoli" => $idtujuan,
                    "idunitkerjaasal" => $dataantrian[0]->idunitkerja,
                    "idbppoliasal" => $dataantrian[0]->idbppoli,
                    "tanggal" => date('Y-m-d H:i:s')
                );

                DBOnTheFly::setConnection($idunitkerja)->table("historypasien")->insert(array_merge($dt, $datapasien));
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

            DBOnTheFly::setConnection($idunitkerja)->table("historypasien")->insert(array_merge($dt, $datapasien));
        }

        return 1;
    }

    private function addAntrianSuara(Request $request)
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
            DBOnTheFly::setConnection($idunitkerja)->table('panggilanantrian')->insert($dt);
            return "ok";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
