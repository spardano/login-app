<?php

namespace App\Imports;

use App\Models\data_penduduk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class pendudukImport implements ToModel
{
    /**
     * @param Collection $collection
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new data_penduduk([
            'nik' => $row[1],
            'kk' => $row[2],
            'tmp_lahir' => $row[3],
            'tgl_lahir' => $row[4],
            'jenkel' => $row[5],
            'goldar' => $row[6],
            'agama' => $row[7],
            'stat_hbkel' => $row[8],
            'status_kawin' => $row[9],
            'pendidikan' => $row[10],
            'pekerjaan' => $row[11],
            'nama_ibu' => $row[12],
            'nama_ayah' => $row[13],
            'alamat' => $row[14],
            'rt' => $row[15],
            'rw' => $row[16],
            'kelurahan' => $row[17],
            'kecamatan' => $row[18],
            'kotakab' => $row[19],
            'propinsi' => $row[20],
            'status_pend' => $row[21],
            'nama' => $row[22],
        ]);
    }
}