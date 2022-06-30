<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeJabatan extends Model
{
    protected $table = 'jabatan';
    protected $fillable = [
        'nama', 'jabatan', 'nip', 'nik', 'gol', 'eselon', 'kode_jabatan'
    ];

    use HasFactory;

    public function jab_kel()
    {
        return $this->hasMany(jabkel::class, 'id_jab', 'id');
    }

    public function suratumum()
    {
        return $this->hasMany(surat_umum::class, 'kode_jabatan', 'kode_jabatan');
    }
}