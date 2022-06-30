<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penomoran_surat extends Model
{
    use HasFactory;
    protected $table = 'penomoran_surat';

    protected $fillable = [
        'id_kel_desa',
        'id_jenis_surat',
        'no_surat',
        'mulai_dari'
    ];

    /**
     * relasi one to one ke klasifikasi surat
     */
    public function klasifikasi_surat()
    {
        return $this->hasOne(KodeSurat::class, 'id', 'id_jenis_surat');
    }

    public function kel_desa()
    {
        return $this->hasOne(kel_desa::class, 'id', 'id_kel_desa');
    }
}