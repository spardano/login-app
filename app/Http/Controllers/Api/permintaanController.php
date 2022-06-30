<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KodeJabatan;
use App\Models\KodeSurat;
use App\Models\surat_umum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class permintaanController extends Controller
{
    public function Suratkepejabat(Request $request)
    {
        $jabatan = KodeJabatan::where('nik', $request->nik)->first();
        $user = User::where('nik', $request->nik)->first();
        $data = surat_umum::with('penduduk')->with('kode_surat')->with('kodejabatan')->where('kode_jabatan', $jabatan->kode_jabatan)->where('id_kel', $user->id_kel_desa)->where('status_surat', '1')->get();
        if ($data) {
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ada'
            ]);
        }
    }
}