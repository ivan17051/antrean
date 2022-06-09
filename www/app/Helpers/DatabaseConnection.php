<?php
namespace App\Helpers;
use Config;
use DB;
use Auth;

class DatabaseConnection
{
    
	
	public static function setConnection($idunitkerja)
    {
        if(config('app.env')=='development') return DB::connection('mysqlapi');

        $r = DB::connection('mysql')->table('munitkerja')
            ->select(
                DB::raw("lower(replace(replace(munitkerja.namaalias,' ',''),'.','')) as n ")
            ) 
            ->where('munitkerja.noid', $idunitkerja)
            ->where('munitkerja.isactive', '1')
            ->where('munitkerja.idtype', '207')
            ->take(1)->first();
        if(!$r){
                $username = 'root';
                $password = 'root';
        }else{
                $username = $r->n;
                $password = 'root';
        }

        config(['database.connections.onthefly' => [
            'driver'   => 'mysql',
            'host'     => '172.18.1.206',
            'port'     => 3306,
            'database' => 'dbantrian',
            'username' => $username,
            'password' => $password,
            'charset'  => 'utf8',
			'collation' =>'utf8_unicode_ci',
            'prefix'   =>   '',
        ]]);

        return DB::connection('onthefly');
    }
}