<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable;
    protected $connection= 'mysql_intralat';
    protected $table = 'users';
    protected $dateFormat = 'Ymd H:i:s.v';
    protected $primarykey = 'id_users';
    public $timestamps = false;

    protected $fillable = [
        'id_users',
        'user',
        'pass',
        'password',
        'nombre',
        'pais',
        'area',
        'puesto',
        'correo',
        'dia_cumple',
        'mes_cumple',
        'telefono',
        'permiso',
        'activo',
    ];

    protected $casts = [
        'id_users' => 'integer',
        'user' => 'string',
        'pass' => 'string',
        'password' => 'string',
        'nombre' => 'string',
        'pais' => 'string',
        'area' => 'string',
        'puesto' => 'string',
        'correo' => 'string',
        'dia_cumple' => 'string',
        'mes_cumple' => 'string',
        'telefono' => 'string',
        'permiso' => 'string',
        'activo' => 'string',
    ];

    protected $hidden = [
        'pass',
        'password',
    ];

    public function scopeRequestUser($query, $requestUserId)
    {
        return $query->where('id_users', '=', $requestUserId)->select([
            'id_users as id',
            'nombre',
            'user',
            'pais'
        ])->first();
    }

    public function permissions() {
        return $this->belongsTo(Permissions::class, 'id_users', 'id_permisos')
            ->select(['id_permisos', 'licenciasSAP']);
    }

}
