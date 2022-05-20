<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AntrianStreamController extends Controller
{
    public function getNomor(Request $request)
    {
        header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream");
        header("Connection: keep-alive");
        $idunitkerja = Auth::user()->idunitkerja;
        $tanggal = $this->datenow;

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
}
