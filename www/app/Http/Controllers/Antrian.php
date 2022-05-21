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


class Antrian extends Controller
{

    public function getListPoli(Request $request)
    {
        $idunitkerja = Auth::user()->idunitkerja;
        $wherepoli = "";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND idbppoli IN (" . implode(",", $filterpoli) . ") ";
        $query = "SELECT idbppoli AS id, policaption AS nama FROM munitkerjapoli WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = '$idunitkerja' $wherepoli ";
		
        $data = DB::connection('mysql')->select($query);
        return Response::json(array('data' => $data));
    }

    public function getNomor(Request $request)
    {
        $idunitkerja = Auth::user()->idunitkerja;
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

        // edited by siannas 
        $panggilanantrian=DB::table('panggilanantrian')
            ->select('text')
            ->where('idunitkerja',$idunitkerja)
            ->where('idbppoli',$filterpoli)
            ->where('noantrian',$now[0]->noantrian)
            ->first();

        $data = array("now" => $now, "next" => $next, "panggilanantrian" => $panggilanantrian);
        // end

        return Response::json(array('data' => $data));
    }

    public function getNomorold(Request $request)
    {
        $idunitkerja = Auth::user()->idunitkerja;
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

    public function getDataPoli($idunitkerja, $idbppoli)
    {
        $tanggal = date('Y-m-d');
        // $tanggal = '2019-08-07';
		
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
        $idunitkerja = Auth::user()->idunitkerja;
        $tanggal = date('Y-m-d');
        // $tanggal = '2019-08-07';

        $wherepoli = "";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND A.idbppoli IN (" . implode(",", $filterpoli) . ") ";
		
        $dokter = DB::connection('mysql')->select("SELECT A.policaption AS bppoli, B.*, C.nama AS namapoli
        	FROM munitkerjapoli A
            LEFT JOIN mdokter B ON A.idunitkerja = B.idunitkerja
            LEFT JOIN mbppoli C ON C.noid = A.idbppoli
			WHERE A.idbppoli=B.idbppoli AND B.isavailable=1 AND B.isactive = 1 AND A.isdirectqueue = 1 AND A.idunitkerja = $idunitkerja $wherepoli ");

        $data = array("dokter" => $dokter);
        
        return Response::json(array('data' => $data));
    }

    public function getListPasien(Request $request)
    {
        $idunitkerja = Auth::user()->idunitkerja;
        $tanggalawal = date('Y-m-d');
		$tanggalakhir = date('Y-m-d', strtotime('+1 day', strtotime($tanggalawal)));
        // $tanggal = '2022-05-12';
		
        $wherepoli = "";
		$wheretanggal = "AND A.tanggaleta >= '{$tanggalawal} 00:00:00' AND A.tanggaleta < '{$tanggalakhir} 00:00:00'";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND A.idbppoli IN (" . implode(",", $filterpoli) . ") ";
		
        $pasien = DB::connection('mysql')->select("SELECT A.pasiennoantrian, A.NAMA_LGKP, A.tanggaleta, A.iscall, A.isrecall, A.isconfirm, A.isserved, A.isskipped, A.isconsul, A.isdone, A.idbppoli, P.nama as poli
			FROM mantrian A
            INNER JOIN mbppoli P ON P.noid = A.idbppoli
			WHERE A.idunitkerja = {$idunitkerja} {$wherepoli} {$wheretanggal} AND A.pasiennoantrian>0 ORDER BY A.pasiennoantrian");
            
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

        $noantrian = 0;

        if ($idbppoli == 0) {
            $wherepoli = "";
        } else {
            $wherepoli = " AND idbppoli = " . $idbppoli . " ";
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

		
        $data = DB::connection('mysql')->select("SELECT A.noid, idunitkerja, idbppoli, B.nama AS bppoli, pasiennoantrian, tanggaleta, DATE_FORMAT(tanggaleta, '%Y-%m-%d') AS tanggallayanan, DATE_FORMAT(tanggaleta, '%H.%i') AS jamestimasi, NIK, NAMA_LGKP  FROM mantrian A LEFT JOIN mbppoli B ON A.idbppoli = B.noid WHERE idunitkerja = $idunitkerja $wherepoli AND DATE(tanggalbuka) = '$tanggal' AND pasiennoantrian > $noantrian $wherehistory
            UNION
            SELECT A.noid, idunitkerja, idbppoli,  B.nama AS bppoli, pasiennoantrian, tanggaleta, DATE_FORMAT(tanggaleta, '%Y-%m-%d') AS tanggallayanan, DATE_FORMAT(tanggaleta, '%H.%i') AS jamestimasi, NIK, NAMA_LGKP FROM mantrianserve A LEFT JOIN mbppoli B ON A.idbppoli = B.noid WHERE idunitkerja = $idunitkerja $wherepoli AND DATE(tanggalbuka) = '$tanggal' AND pasiennoantrian > $noantrian $wherehistory ORDER BY pasiennoantrian ");
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
            $idunitkerja = Auth::user()->idunitkerja; //Input::get('idunitkerja');
            $noantrian   = $request->input('pasiennoantrian');
            $idbppoli    = $request->input('idbppoli');
            $tipe = $request->input('tipe');

            $res = DB::table('munitkerjapolidaily')
                ->where('idunitkerja', $idunitkerja)
                ->where('idbppoli', $idbppoli)
                ->where('servesdate', $tanggal)
                ->take(1)->first();

            if ($res) {
                if ($res->servesno + 1 > $res->servesmax) {
                    throw new Exception("Semua Antrian Sudah Dilayani");
                } else {
                    DB::table('munitkerjapolidaily')
                        ->where('noid', $res->noid)
                        ->update([
                            'servesno' => $res->servesno + 1,
                            "servestime" => date('Y-m-d H:i:s')
                        ]);

                    if ($tipe == 1) {
                        $nomor = $res->servesno + 1;
                        $data = DB::select("SELECT NIK, NAMA_LGKP AS nama FROM mantrian WHERE idunitkerja = $idunitkerja AND idbppoli = $idbppoli AND DATE(tanggalbuka) = '$tanggal' AND pasiennoantrian = $nomor LIMIT 1 ");

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
                    }

                    $dthistory = array(
                        "noid" => $res->noid,
                        "tanggal" => $tanggal,
                        "idbppoli" => $idbppoli,
                        "idunitkerja" => $idunitkerja,
                        "pasiennoantrian" => $res->servesno + 1,
                    );
                    $addhistory = $this->addhistory(2, new Request($dthistory));

                    $idreturn = 1;
                }
            } else {
                throw new Exception("Antrian selanjutnya tidak ditemukan");
            }
        } catch (Exception $e) {
            DB::rollback();
            $idreturn = $e->getMessage();
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
		
        $idunitkerja = Auth::user()->idunitkerja;
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
        $idunitkerja = Auth::user()->idunitkerja;
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
        $idunitkerja = Auth::user()->idunitkerja;
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