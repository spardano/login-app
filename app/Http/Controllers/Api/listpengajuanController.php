<?php

namespace App\Http\Controllers;

use App\Models\roleuser;
use App\Models\surat_umum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class listpengajuanController extends Controller
{
    public function pengajuansaya()
    {
        $user = roleuser::whereHas('role_id', function ($query) {
            $query->where('user_id', Auth::user()->id);
        });

        if ($user->role_id == 2) {
            $data = surat_umum::with('penduduk')->with('KlasifikasiSurat')->with('kodejabatan')->where('nik', Auth::user()->nik)->get();
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }
    }
}