<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\data_penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function getprofileUser(Request $request)
    {
        $user = User::with('kelurahan')->where('nik', Auth::user()->nik)->first();
        if ($user) {
            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ada'
            ]);
        }
    }
}