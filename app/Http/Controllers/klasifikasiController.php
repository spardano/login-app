<?php

namespace App\Http\Controllers;

use App\Models\KodeSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class klasifikasiController extends Controller
{
    public function index()
    {
        $klasifikasiSurat = KodeSurat::get();
        return view('admin.klasifikasiSurat.index', [
            'data' => $klasifikasiSurat
        ]);
    }

    public function store(Request $request)
    {
        $klasifiksitambah = new KodeSurat();
        $klasifiksitambah->kode_surat = $request->kode_surat;
        $klasifiksitambah->uraian = $request->uraian;
        $klasifiksitambah->spesifikasi_surat = $request->spesifikasi_surat;
        $klasifiksitambah->save();

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $klasifiksiedit = KodeSurat::where('id', $id)->first();
        $klasifiksiedit->kode_surat = $request->kode_surat;
        $klasifiksiedit->uraian = $request->uraian;
        $klasifiksiedit->spesifikasi_surat = $request->spesifikasi_surat;
        $klasifiksiedit->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $klasifikasihapus = KodeSurat::where('id', $id)->first();
        $klasifikasihapus->delete();
        return redirect()->back();
    }
}