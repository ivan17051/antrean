<?php
namespace App\Helpers;
use Config;
use DB;
use Auth;

class SyncAntrian
{
    
	
	public static function setConnection($idunitkerja)
    {
        $r = DB::connection('mysql')->table('munitkerja')
            ->select(
                DB::raw("lower(replace(replace(munitkerja.namaalias,' ',''),'.','')) as n ")
            ) 
            ->where('munitkerja.noid', $idunitkerja)
            ->where('munitkerja.isactive', '1')
            ->where('munitkerja.idtype', '207')
            ->take(1)->first();

    }
}