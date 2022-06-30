<?php

namespace App\Http\Controllers;

use App\Models\kel_desa;
use App\Models\KodeSurat;
use App\Models\penomoran_surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenomoranSuratController extends Controller
{
    /**
     * method index untuk memanggil view index
     * return View Index Penomoran Surat
     */
    public function index()
    {
        if (Auth::user()->id_kel_desa != 52) {
            //admin kelurahan
            $penomoran_surat = penomoran_surat::with('klasifikasi_surat')->where('id_kel_desa', Auth::user()->id_kel_desa)->get();
            $kelurahan = kel_desa::where('id', Auth::user()->id_kel_desa)->get();
        } else {
            //admin
            $kelurahan = kel_desa::get();
            $penomoran_surat = penomoran_surat::with('klasifikasi_surat')->get();
        }

        $kode_surat = KodeSurat::where('spesifikasi_surat', 'umum')->get();

        return view('admin.Penomoran.index', [
            "kode_surat" => $kode_surat,
            "kelurahan" => $kelurahan,
            "penomoran_surat" => $penomoran_surat
        ]);
    }

    /**
     * method untuk menyimpan penomoran surat baru
     * Parameter Request $request
     * Return Redirect
     */
    public function store(Request $request)
    {
        $penomoran_surat = penomoran_surat::create([
            "id_kel_desa" => $request->id_kel_desa,
            "id_jenis_surat" => $request->id_jenis_surat,
            "no_surat" => $request->no_surat,
            "mulai_dari" => $request->mulai_dari
        ]);

        if ($penomoran_surat) {
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        }

        return redirect()->back()->with('failed', 'Data gagal ditambahkan');
    }

    public function update(Request $request)
    {

        $penomoran_surat = penomoran_surat::where('id', $request->id)->first();
        $penomoran_surat->id_kel_desa = $request->id_kel_desa;
        $penomoran_surat->id_jenis_surat = $request->id_jenis_surat;
        $penomoran_surat->no_surat = $request->no_surat;
        $penomoran_surat->mulai_dari = $request->mulai_dari;
        $penomoran_surat->save();

        if ($penomoran_surat) {
            return redirect()->back()->with('success', 'Data berhasil dirubah');
        }

        return redirect()->back()->with('failed', 'Gagal Mengubah Penomoran Otomatis');
    }


    public function delete($id)
    {
        $penomoran_surat = penomoran_surat::where('id', $id)->first();
        $penomoran_surat->delete();

        if ($penomoran_surat) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Penomoran Otomatis');
        }

        return redirect()->back()->with('failed', 'Gagal Menghapus Penomoran Otomatis');
    }
}