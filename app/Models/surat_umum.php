<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_umum extends Model
{
    use HasFactory;
    protected $table = 'surat_umum';
    protected $fillable = ['id', 'nik', 'kode_surat', 'kode_jabatan', 'alasan', 'tujuan', 'status_surat','document', 'id_kel', 'tgl_surat'];

    public function KlasifikasiSurat()
    {
        return $this->hasOne(KodeSurat::class, 'kode_surat', 'kode_surat');
    }
    public function kode_surat()
    {
        return $this->hasOne(KodeSurat::class, 'kode_surat', 'kode_surat');
    }

    public function getkodeDesa()
    {
        return $this->hasOne(kel_desa::class, 'id', 'id_kel');
    }

    public function penduduk()
    {
        return $this->hasOne(data_penduduk::class, 'nik', 'nik');
    }

    public function kodejabatan()
    {
        return $this->hasOne(KodeJabatan::class, 'kode_jabatan', 'kode_jabatan');
    }

    public function nosurat()
    {
        return $this->hasOne(penomoran_surat::class, 'id', 'no_surat');
    }
}