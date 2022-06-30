<?php

namespace App\Http\Controllers;

//panggil seluruh models yang akan digunakan
use App\Models\jabkel;
use App\Models\KodeJabatan;
use App\Models\surat_umum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PejabatController extends Controller
{

    //==INDEX==////////////////////////////////////////////////////////////////////////////////////////////////
    public function index()
    {
        if (Auth::user()->id_kel_desa != 52) { // kondisi user bukan admin
            // ambil jabatan sesuai dengan id kelurahan dimana id kelurahan nya 
            // sama dengan id kelurahan user
            $jabatan = KodeJabatan::whereHas('jab_kel', function ($query) {
                $query->where('id_kel', Auth::user()->id_kel_desa);
            })->get();
        } else { //kondisi user adalah admin
            // ambil seluruh data jabatan
            $jabatan = KodeJabatan::get();
        }
        //kembalikan seluruh nilai diatas ke halaman view pejabat
        return view('admin.pejabat.index', [
            "data" => $jabatan

        ]);
    }
    //==END==INDEX==////////////////////////////////////////////////////////////////////////////////////////////////



    //==TAMBAH PEJABAT==////////////////////////////////////////////////////////////////////////////////////////////////

    public function tambah(Request $request)
    {
        // Menampung seluruh Inputan
        $jabatan = new KodeJabatan();
        $jabatan->nama = $request->nama;
        $jabatan->jabatan = $request->jabatan;
        $jabatan->nip = $request->nip;
        $jabatan->nik = $request->nik;
        $jabatan->gol = $request->gol;
        $jabatan->eselon = $request->eselon;
        $jabatan->kode_jabatan = $request->kode_jabatan;
        $jabatan->save(); //simpan semua inputan

        if (Auth::user()->id_kel_desa != 52) { //kondosi user bukan admin
            // tambahkan di table jabkel id_kel dan id_jab sebagai jabatan baru 
            // sesuai dengan kelurahan user
            $jabkel = new jabkel();
            $jabkel->id_kel = Auth::user()->id_kel_desa;
            $jabkel->id_jab = $jabatan->id;
            $jabkel->save(); // save jabatan baru dengan id keluran user

            if ($jabkel) {
                return redirect()->back()->with('success', 'Data berhasil ditambahkan');
            }

            return redirect()->back()->with('failed', 'Data Gagal ditambahkan');
        }
        //kembalikam kehalaman pejabat
    }
    //==END TAMBAH PEJABAT==////////////////////////////////////////////////////////////////////////////////////////////////



    //==EDIT DATA PEJABAT==////////////////////////////////////////////////////////////////////////////////////////////////

    public function edit(Request $request)
    {
        // menampung nilai seluruh inputan dengan parameter id
        $jabatan  = KodeJabatan::where('id', $request->id)->first();
        $suratumum = surat_umum::where('kode_jabatan', $jabatan->kode_jabatan);
        //dimana param id sama dengan id jabatan

        // if ($request->hasFile('ttd')) {
        // $request->file('ttd')->move('ttdpejabat/', $request->file('ttd')->getClientOriginalName());
        // $jabatan->ttd = $request->file('ttd')->getClientOriginalName();
        $jabatan->nama = $request->nama;
        $jabatan->jabatan = $request->jabatan;
        $jabatan->nip = $request->nip;
        $jabatan->nik = $request->nik;
        $jabatan->gol = $request->gol;
        $jabatan->eselon = $request->eselon;
        $jabatan->kode_jabatan = $request->kode_jabatan;
        $jabatan->save(); //simpan tampungan inputan


        if ($jabatan) {
            $suratumum->update([
                'kode_jabatan' => $request->kode_jabatan
            ]);

            return redirect()->back()->with('success', 'Data berhasil diubah');
        }

        return redirect()->back()->with('failed', 'Data gagal diubah');
        //kemnbalikan halaman ke halaman pejabat
    }
    //==END EDIT DATA PEJABAT==////////////////////////////////////////////////////////////////////////////////////////////////



    //==DELETE DATA PEJABAT==////////////////////////////////////////////////////////////////////////////////////////////////

    public function delete($id) // function delete dengan param ID
    {
        //ambil data dari jabkel dimana id_jab sama dengan id parameter
        $jabatan  = jabkel::where('id_jab', $id)->first();
        $jabatan->delete(); //delete seluruh data jabkel yang sesuai dengan id parameter
        if ($jabatan) { // kondisi jika delete berhasil
            // ambil data KodeJabatan diaman id nya sama dengan parameter 
            $hapus = KodeJabatan::where('id', $id)->first();
            $hapus->delete(); // delete seluruh nilai dari kode jabatan yang sesuai id param
        }
        if ($jabatan) {
            return redirect()->back()->with('success', 'Jabatan Berhasil dihapus');
        }
        //kembalikan halaman pejabat
        return redirect()->back()->with('failed', 'Jabatan gagal dihapus');
    }
    //==END DELETE DATA PEJABAT==////////////////////////////////////////////////////////////////////////////////////////////////
}