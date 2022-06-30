<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\data_penduduk;
use App\Models\KodeSurat;
use App\Models\surat_nikah;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class SuratNikahController extends Controller
{



    //mengambil data surat_nikah dari models====================================================

    function getdatasuratnikah(Request $request)
    {
        //mencari nik_calon yang sesuai dengan nik user ditampung kedalam variabel alldata
        $alldata = surat_nikah::with('kode_surat')->where('nik_calon', $request->nik)->get();
        if ($alldata) {               //jika berhasil 
            return response()->json([ //kembalikan respon json status true
                'status' => true,
                'data' => $alldata    //kembalikan data yang diminta   
            ]);
        }
        return response()->json([        //jika gagal
            'status' => false,           //kembalikan response status false
            'message' => 'data tidak ada'
        ]);
    }

    //==========================================================================================



    //mengambil data penduduk dari models ke DB=================================================
    public function getdatapenduduk()
    {
        $penduduk = data_penduduk::get();    //tampung data dalam variabel penduduk
        if ($penduduk) {                     //jika berhasil
            return response()->json([        //kirim response dalam bentuk json 
                'status' => true,
                'data_penduduk' => $penduduk //kirim data dalam variabel data_penduduk
            ]);
        }
        return response()->json([               //jika gagal kirim respon dalam bntuk json
            'status' => false,                  // isi response status dan message
            'message' => 'data tidak ditemukan'
        ]);
    }

    //==========================================================================================



    //menginput data inputan user ke dalam Table surat_nikah DB=================================
    public function submitsuratnikah(Request $request)
    {
        $datacalon = data_penduduk::where('nik', $request->nik_calon)->first();
        $datapasangan = data_penduduk::where('nik', $request->nik_pasangan)->first();

        //kondisi
        if ($datacalon['status_kawin'] == 'Belum') {

            if ($datapasangan['status_kawin'] == 'Belum') {
                $suratnikah = surat_nikah::create([     //data ditampung dalam variabel suratnikah
                    'nik_calon' => $request->nik_calon,
                    'nik_pasangan' => $request->nik_pasangan,
                    'nik_ortulaki' => $request->nik_ortulaki,
                    'nik_ortupere' => $request->nik_ortupere,
                    'suku_calon' => $request->suku_calon,
                    'suku_pasangan' => $request->suku_pasangan,
                    'nama_mamak' => $request->nama_mamak,
                    'tmplahir_mamak' => $request->tmplahir_mamak,
                    'tgllahir_mamak' => $request->tgllahir_mamak,
                    'negeriasal_mamak' => $request->negeriasal_mamak,
                    'bangsa_mamak' => $request->negeriasal_mamak,
                    'kerja_mamak' => $request->negeriasal_mamak,
                    'alamat_mamak' => $request->alamat_mamak,
                    'kawin_ke' => $request->kawin_ke,
                    'tgl_nikah' => $request->tgl_nikah,
                    'jam_nikah' => $request->jam_nikah,
                    'tempat_nikah' => $request->tempat_nikah,
                    'mahar_nikah' => $request->mahar_nikah,
                ]);
                if ($suratnikah) {             //jika data berhasil diinput
                    return response()->json([  // kirim response status dan message dalan bentuk json
                        'status' => true,
                        'message' => 'Pengajuan Berhasil Dilakukan'
                    ]);
                }
            }
            return response()->json([   //jika gagal respon status false
                'status' => false,
                'message' => 'Anda Tidak Dapat Melakukan Permintaan Karna Status Kewarga Negaraan Pasangan atau Anda Sudah Kawin'
            ]);
        }

        return response()->json([   //jika gagal respon status false
            'status' => false,
            'message' => 'Anda Tidak Dapat Melakukan Permintaan Karna Status Kewarga Negaraan Pasangan atau Anda Sudah Kawin'
        ]);
    }

    //==========================================================================================



    //fungsi request data nik ortu laki dari data_penduduk dengan kk yang sama==================

    public function getNikOrtuLaki(Request $request)
    {
        //meminta data kk yang nik nya sama dengan nik user tampung di dalam variabel no_kk
        $no_kk = data_penduduk::select('kk')->where('nik', $request->nik)->first();

        //meminta data nik dimana stat_hbkel nya adalah orang tua laki yang no_kk nya sama dengan kk user
        $nikortulaki = data_penduduk::select('nik')->where('stat_hbkel', 'Orang Tua Laki-laki')->where('kk', $no_kk->kk)->first();

        if ($nikortulaki->nik) {        //jika berhasil
            return response()->json([   //response dalam json true
                "status" => true,       // jika true
                "nik_ortulaki" => $nikortulaki->nik, //tampung data dalam variabel nik_ortulaki
            ]);
        }

        return response()->json([   //jika gagak reponse status false
            'status' => false,      // data tidak ada 
            'message' => 'Nik Ortu laaki-laki tidak ditemukan'
        ]);
    }

    //==========================================================================================



    //fungsi request data nik ortu pere dari data_penduduk dengan kk yang sama==================
    public function getNikOrtuPere(Request $request)
    {
        $no_kk = data_penduduk::select('kk')->where('nik', $request->nik)->first();

        $nikortupere = data_penduduk::select('nik')->where('stat_hbkel', 'Orang Tua perempuan')->where('kk', $no_kk->kk)->first();

        if ($nikortupere->nik) {
            return response()->json([
                "status" => true,
                "nik_ortupere" => $nikortupere->nik,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nik Ortu perempuan tidak ditemukan'
        ]);
    }

    //==========================================================================================



    //fungsi untuk mengambil data dari models kodesurat ke DB surata_mikah======================
    public function getSuratNikah()
    {
        $surat = KodeSurat::where('spesifikasi_surat', 'nikah')->get();
        if ($surat) {
            return response()->json([
                'status' => true,
                'kode_surat' => $surat
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'data jabatan tidak ada'
        ]);
    }
    //==========================================================================================
}