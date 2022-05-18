<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'munitkerja';

    public $timestamps = false;

    protected $fillable = [
        "kode",
        "barcode",
        "nama",
	    "namaalias",
        "namakapus",
        "bioprofile",
        "layananunggulan",
        "photokapus",
        "photoprofile",
        "alamat1",
        "alamat2",
        "idc",
        "idm"
    ];
}
