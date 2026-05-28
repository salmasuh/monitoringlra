<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    protected $fillable = [
        'nama',
        'singkatan',
        'deskripsi',
    ];

    public function pjskpds()
    {
        return $this->hasMany(PjSkpd::class);
    }

    public function monitorings()
    {
        return $this->hasMany(Monitoring::class);
    }
}