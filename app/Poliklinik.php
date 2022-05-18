<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    protected $table = 'mbppoli';

    public $timestamps = false;

    protected $fillable = [
        "kode",
        "nama",
	    "namabdh",
        "namasoewandi",
        "isbase",
        "isactive",
        "isinlet",
        "idpj",
        "keterangan",
        "isspesialis",
        "nourut",
        
    ];
}
