<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_nikah extends Model
{
    use HasFactory;
    protected $table = 'surat_nikah';
    protected $fillable = [
        'id',
        'nik_calon', 'nik_pasangan', 'nik_ortulaki', 'nik_ortupere', 'kode_surat',
        'suku_calon', 'suku_pasangan', 'nama_mamak', 'tmplahir_mamak', 'tgllahir_mamak',
        'negeriasal_mamak', 'bangsa_mamak', 'kerja_mamak', 'alamat_mamak', 'kawin_ke',
        'tgl_nikah', 'jam_nikah', 'tempat_nikah', 'mahar_nikah'
    ];

    // public function kode_surat()
    // {
    //     return $this->hasOne(KodeSurat::class, 'kode_surat', 'kode_surat');
    // }

    public function klasifikasiSurat()
    {
        return $this->hasOne(KodeSurat::class, 'kode_surat', 'kode_surat');
    }

    public function penduduk()
    {
        return $this->hasOne(data_penduduk::class, 'nik', 'nik_calon');
    }

    public function penduduk_pasangan()
    {
        return $this->hasOne(data_penduduk::class, 'nik', 'nik_pasangan');
    }
}