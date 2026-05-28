<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable = [
        'skpd_id',
        'pj_skpd_id',
        'status',
        'tanggal_update',
        'catatan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    public function pjskpd()
    {
        return $this->belongsTo(PjSkpd::class, 'pj_skpd_id');
    }
}