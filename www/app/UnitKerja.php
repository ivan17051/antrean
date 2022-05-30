<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    //
    protected $table = 'munitkerja';

    protected $fillable = [
        'kode', 
        'nama', 
        'namaalias',
        'namakapus',
        'bioprofile',
        'layananunggulan',
        'photokapus',
        'photoprofile',
        'doc',
        'idc',
        'dom',
        'idm',
        'alamat1',
        'alamat2',
        'RT',
        'RW',
        'idlokasi',
        'idpj',
        'idpj2',
        'idparent',
        'idreportto',
        'idpuskesmas',
        'isinlet',
        'depthlevel',
        'latitude',
        'longitude',
        'isactive',
        'idtype',
        'keterangan',
        'telp',
        'extension',
        'password',
        'wilayahkerja',
        'isigd',
        'israwatinap',
        'islayanansore',
        'isbpjs',
        'isiso',
        'idwilayah',
        'wilayahkota',
    ];
}
