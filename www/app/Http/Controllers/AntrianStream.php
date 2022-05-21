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


class AntrianStream extends Controller
{
	public function getNomor(Request $request)
    {
		
        header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream");
        header("Connection: keep-alive");
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

        echo "retry: 3000\n";
        $data = json_encode(["now" => $now, "next" => $next]);

        echo "data: " . $data. "\n\n";

        flush();
    }

    public function getPanggilanAntrian(Request $request)
    {
		
        header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream");
        header("Connection: keep-alive");
        $tanggal = date('Y-m-d');
        $idunitkerja = Auth::user()->idunitkerja;
        $filterpoli = $request->input('poli');

        $data = DB::connection('mysql')->table('panggilanantrian')
            ->leftJoin('mbppoli', 'panggilanantrian.idbppoli', '=', 'mbppoli.noid')
            ->where('idunitkerja', $idunitkerja)
            ->where('iscall', 0)
            ->where('tanggal', $tanggal)
            ->when($filterpoli, function ($query) use ($filterpoli) {
                return $query->whereIn('idbppoli', $filterpoli);
            })
            ->select('panggilanantrian.*', 'mbppoli.nama AS namapoli')
            // ->inRandomOrder()
            ->orderBy('id')
            ->first();

        $timeout = 2000;
        if($data){
        	$noantrian = $data->noantrian;
        	$timeout = 3500;
        	if($noantrian<12){
		        $timeout += 1500;
		    } else if($noantrian<20){
		        $timeout += 1800;
		    } else if($noantrian<100){
		        $timeout+= 2600;
		    } else if($noantrian<200){
		        $timeout += 3000;
		    } else if($noantrian>1000){
		        $timeout += 5000;
		    } else {
		        $timeout = 2000;
		    }
        }

        echo "retry: $timeout \n";
        echo "data:" . json_encode($data) . "\n\n";
        flush();
    }
}