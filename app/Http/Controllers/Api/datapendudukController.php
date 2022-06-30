<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Models\data_penduduk;
use App\Models\KodeSurat;



class datapendudukController extends Controller
{
    //menampung data penduduk untuk di input ke dalam DB
    public function submitPenduduk(Request $request)
    {
        $datapenduduk = data_penduduk::create([
            'nik' => $request->nik, 'kk' => $request->kk,
            'nama' => $request->nama, 'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir, 'jenkel' => $request->jenkel,
            'goldar' => $request->goldar, 'agama' => $request->agama,
            'stat_hbkel' => $request->stat_hbkel, 'status_kawin' => $request->status_kawin,
            'pendidikan' => $request->pendidikan, 'pekerjaan' => $request->pekerjaan,
            'nama_ibu' => $request->nama_ibu, 'nama_ayah' => $request->nama_ayah,
            'alamat' => $request->alamat, 'rt' => $request->rt,
            'rw' => $request->rw, 'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan, 'kotakab' => $request->kotakab,
            'propinsi' => $request->propinsi, 'status_pend' => $request->status_pend
        ]);
        if ($datapenduduk) {                            //jika data penduduk berhasil di input
            return response()->json([                   //kembalikan dalam bentuk respon json
                'status' => true,
                'message' => 'data berhasil di inputkan'
            ]);
        }
        return response()->json([                       //jika gagal kemblikan respon gagal
            'status' => false,
            'message' => 'data gagal di inputkan'
        ]);
    }

    //mengambil data penduduk dari DB
    public function getdatapenduduk()
    {
        $penduduk = data_penduduk::get();     //data penduduk ditampung dalam variabel $penduduk
        if ($penduduk) {                      //jika berhasil 
            return response()->json([         //kembalikan respon status = true
                'status' => true,
                'data_penduduk' => $penduduk  //kembalikan datapenduduk dalam variabel 'data_penduduk'
            ]);
        }
        return response()->json([             //jika gagal kembalikan respon json status false
            'status' => false,
            "message" => 'data tidak ditemukan'
        ]);
    }
}