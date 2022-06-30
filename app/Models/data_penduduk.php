<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class data_penduduk extends Model
{
    use HasFactory;
    protected $table = 'data_penduduks';
    protected $fillable = [
        'nik', 'kk', 'nama', 'tmp_lahir', 'tgl_lahir', 'jenkel', 'goldar', 'agama', 'stat_hbkel', 'status_kawin',
        'pendidikan', 'pekerjaan', 'nama_ibu', 'nama_ayah', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan',
        'kotakab', 'propinsi', 'status_pend'
    ];

    public function Editpenduduk($nik, $data)
    {
        DB::table('data_penduduks')->where('nik', $nik)->update($data);
    }

    public function getdatakeldes()
    {
        return $this->hasOne(kel_desa::class, 'id', 'kelurahan');
    }
}