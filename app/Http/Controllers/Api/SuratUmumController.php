<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\data_penduduk;
use App\Models\KodeJabatan;
use App\Models\KodeSurat;
use App\Models\surat_umum;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;


class SuratUmumController extends Controller
{



    //mengirim datasurat umum

    function getsuratumum(Request $request)
    {
        $alldata = surat_umum::with('kode_surat')->where('nik', $request->nik)->where('status_surat', "!=", 2)->get();

        if ($alldata) {
            return response()->json([
                'status' => true,
                'data' => $alldata
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'data tidak ada'
        ]);
    }

    //End 



    // Data Kelurahan dari tabel penduduk BERDASARKAN NIK

    public function getkelurahan(Request $request)
    {
        $kelurahan = data_penduduk::where('nik', $request->nik)->first();

        if ($kelurahan) {
            return response()->json([
                'status' => true,
                'kelurahan' => $kelurahan
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'data tidak ada'
        ]);
    }

    //END



    // DATA PEJABAT

    public function getKodeJabatan()
    {
        $kode_jabatan = KodeJabatan::get();
        if ($kode_jabatan) {
            return response()->json([
                'status' => true,
                'jabatan' => $kode_jabatan
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'data jabatan tidak ada'
        ]);
    }

    //END


    //DATA KLASIFIKASI SURAT UMUM

    public function getKodeSurat()
    {
        $surat = KodeSurat::where('spesifikasi_surat', 'umum')->get();
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

    //END



    //MENYIMPAN PERMINTAAN SURAT UMUM

    public function submitSuratUmum(Request $request)
    {

        $penduduk = data_penduduk::where('nik', $request->nik)->first();

        $suratumum = surat_umum::create([
            'nik' => $request->nik,
            'kode_surat' => $request->kode_surat,
            'alasan' => $request->alasan,
            'tujuan' => $request->tujuan,
            'status_surat' => '0',
            'id_kel' => $penduduk->kelurahan,
            'tgl_surat' => $request->tanggal_surat,
            'kode_jabatan' => '000'
        ]);
        if ($suratumum) {
            return response()->json([
                'status' => true,
                'message' => 'pengajuan berhasil dilakukan'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'pengajuan gagal disimpan'
        ]);
    }

    //END



    //FILE SURAT UMUM YANG DI SETUJUI
    public function FileSurat(Request $request)
    {
        $file_name = surat_umum::where('nik', $request->nik)->with('kode_surat')->where('status_surat', 2)->get();

        if ($file_name) {
            return response()->json([
                'status' => true,
                'data' => $file_name
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ada'
            ]);
        }
    }
    //END

    public function FileSingleSurat(Request $request)
    {
        $file_name = surat_umum::where('id', $request->id)->with('kode_surat')->where('status_surat', 2)->first();

        if ($file_name) {
            return response()->json([
                'status' => true,
                'data' => $file_name
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ada'
            ]);
        }
    }
}