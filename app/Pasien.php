<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'mpasien';

    public $timestamps = false;

    protected $fillable = [
        "nik",
        "nama",
	    "jeniskelamin",
        "tgllahir",
        "agama",
        "pendidikan",
        "pekerjaan",
        "goldarah",
        "no_kel",
        "nama_kel",
        "no_kec",
        "nama_kec",
        "no_kab",
        "nama_kab",
        "no_prop",
        "nama_prop",
        "alamat",
        "rt",
        "rw",
        "issurabaya",
        "nohp",
        "idcreate",
        "docreate",
        "idupdate",
        "lastupdate",
    ];
}
