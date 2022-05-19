<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitKerjaPoli extends Model
{
    protected $table = 'munitkerjapoli';

    public $timestamps = false;

    protected $fillable =[
        "noid",
        "idunitkerja",
        "idbppoli",
        "policaption",
        "jambuka",
        "jamtutup",
        "jamlayanan",
        "maxquota",
        "avgservice",
        "avgtindakan",
        "avgnontindakan",
        "estservice",
        "noserver",
        "isdirectqueue",
        "maxnextdate",
        "harilayanan",
        "namapj",
        "isday01",
        "jambuka01",
        "jamtutup01",
        "jamlayanan01",
        "isday02",
        "jambuka02",
        "jamtutup02",
        "jamlayanan02",
        "isday03",
        "jambuka03",
        "jamtutup03",
        "jamlayanan03",
        "isday04",
        "jambuka04",
        "jamtutup04",
        "jamlayanan04",
        "isday05",
        "jambuka05",
        "jamtutup05",
        "jamlayanan05",
        "isday06",
        "jambuka06",
        "jamtutup06",
        "jamlayanan06",
        "isday07",
        "jambuka07",
        "jamtutup07",
        "jamlayanan07",
        "isactive",
        "idupdate",
        "lastupdate",
        "nourut",
        "idindexmaster",
        "iddevice",
    ];
}
