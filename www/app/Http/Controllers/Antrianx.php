<?php namespace App\Http\Controllers;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
use DateTime, DateTimeZone;
use Exception;
use Illuminate\Http\Request;


class Antrianx extends Controller {

	public function index(Request $request){
        $d = array();
        $d['title'] = "Antrean Puskesmas";
        $d['subtitle'] = "antrean";
        
        return view('antreanPuskesmas', compact('d'));
    }

    public function getNomor(Request $request)
    {
        $idunitkerja = $request->input('idunitkerja');
        $tanggal = ($request->input('tanggal')) ? $request->input('tanggal') : date('Y-m-d');
        // $tanggal = '2019-08-07';

        $wherepoli = "";
        $filterpoli = $request->input('poli');
        if ($filterpoli) $wherepoli = " AND A.idbppoli IN (" . implode(",", $filterpoli) . ") ";

        $now = DB::connection('mysql')->select("SELECT A.policaption AS bppoli, A.idbppoli, COALESCE(X.noantrian,0) AS noantrian, X.servesmax
            FROM munitkerjapoli A
            LEFT JOIN ( 
                SELECT A.idbppoli, COALESCE(A.servesno,0) AS noantrian, A.servesmax FROM munitkerjapolidaily A
                    WHERE A.idunitkerja = $idunitkerja AND A.servesdate = '$tanggal'
            ) X ON A.idbppoli = X.idbppoli
            WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = $idunitkerja $wherepoli ");

        // $next = DB::connection('mysql')->select("SELECT A.policaption AS bppoli, X.*, 
        //     CASE WHEN X.noantrian = 1 THEN DATE_FORMAT(A.jambuka, '%H.%i') ELSE DATE_FORMAT(DATE_ADD(COALESCE(X.servestime,NOW()), INTERVAL A.avgtindakan SECOND), '%H.%i') END AS jamestimasi,
        //     ROUND((A.avgtindakan+30)/60) AS waktutindakan, ROUND((A.avgnontindakan+30)/60) AS waktunontindakan
        //     FROM munitkerjapoli A
        //     LEFT JOIN ( 
        //         SELECT A.idbppoli, A.servesno + 1 AS noantrian, A.servesmax, A.servestime FROM munitkerjapolidaily A
        //             WHERE A.idunitkerja = $idunitkerja AND A.servesdate = '$tanggal'
        //     ) X ON A.idbppoli = X.idbppoli
        //     WHERE isactive = 1 AND isdirectqueue = 1 AND idunitkerja = $idunitkerja $wherepoli ");

        $data = ["now" => $now];

        return Response::json(array('data' => $data));
    }
}