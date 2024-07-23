<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{

    //use HasFactory;
    protected $connection= 'mysql_intralat';
    protected $table = 'permisos';
    protected $dateFormat = 'Ymd H:i:s.v';
    protected $primaryKey = 'id_permisos';
    public $timestamps = false;
    protected $fillable = [
        'id_permisos',
        'licenciasSAP',
    ];

    protected $casts = [
        'id_permisos' => 'integer',
        'licenciasSAP' => 'string',
    ];
}
