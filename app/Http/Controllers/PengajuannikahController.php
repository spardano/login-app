<?php

namespace App\Http\Controllers;


use App\Models\surat_nikah;
use PDF;

class PengajuannikahController extends Controller
{
    public function index()
    {
        $suratnikah = surat_nikah::with('penduduk')->with('klasifikasiSurat')->with('penduduk_pasangan')->get();

        return view('admin.suratnikah.index', [
            "title" => "SingelPost",
            "data" => $suratnikah
        ]);
    }



    public function pdfnikah($nik_calon)
    {

        $data = surat_nikah::where('id', $nik_calon)->with('penduduk')->with('KlasifikasiSurat')->first();

        $stringNamaView = '';
        if ($data['kode_surat'] === '019') {
            $stringNamaView = 'FormulirPermohonanKehendakNikah';
        } else if ($data['kode_surat'] === '015') {
            $stringNamaView = "suratizinorangtua";
        } else if ($data['kode_surat'] === '016') {
            $stringNamaView = "FormulirPersetujuanCalonPengantin";
        } else if ($data['kode_surat'] === '018') {
            $stringNamaView = "suratpernyataancalonmempelai";
        }

        $pdf = PDF::loadview('admin.suratnikah.' . $stringNamaView, [
            "data" => $data
        ])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}