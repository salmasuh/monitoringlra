<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PjSkpd extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'skpd_id',
        'no_hp',
        'email',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */
    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    public function pjskpds()
    {
        return $this->hasMany(PjSkpd::class);
    }
}