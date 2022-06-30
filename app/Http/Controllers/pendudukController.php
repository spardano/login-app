<?php

namespace App\Http\Controllers;

//panggil seluruh models yang akan digunakan
use App\Exports\pendudukExport;
use App\Models\data_penduduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\pendudukImport;
use App\Models\kel_desa;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class pendudukController extends Controller
{
    //==INDEX==//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index() //function halaman index Menu Penduduk 
    {
        $userLogin = Auth::user(); // tampung data user sedang login
        //tampung data dari table user dimana id nya sama dengan id user sedang login
        $user = User::where('id', $userLogin->id)->first();

        $kelurahan = kel_desa::get();
        // menampung data table data_penduduk dengan id dari method kel_desa sama dengan kelurahan di data penduduk
        $keldes = data_penduduk::with('kel_desa')->where('id', 'kelurahan')->first();
        if ($user->hasRole(['admin'])) { //kondisi jika login admin
            //tampung seluruh data dari table data_penduduk
            $penduduk = data_penduduk::get();
        } else if ($user->hasRole(['adminkelurahan'])) { // kondisi login admin kelurahan
            //tampung data_penduduk dengan method getdatakeldes dimana kelurahan dari data_penduduk 
            //sama dengan id_kel_desa user yang login 
            $penduduk = data_penduduk::with('getdatakeldes')->where('kelurahan', $user->id_kel_desa)->get();
        } else if ($user->hasRole(['pejabat'])) {
            $penduduk = data_penduduk::with('getdatakeldes')->where('kelurahan', $user->id_kel_desa)->get();
        }

        // kembalikan seluruh nilai diatas kehalaman view penduduk index
        return view('admin.penduduk.index', [
            'title' => 'datapenduduk',
            'data' => $penduduk,
            'keldes' => $keldes,
            'kelurahan' => $kelurahan
        ]);
    }
    //==END INDEX==//////////////////////////////////////////////////////////////////////////////////////////////////////



    //==Tambah Data Penduduk==///////////////////////////////////////////////////////////////////////////////////////////
    public function store(Request $request)
    {
        $penduduk = new data_penduduk();
        $penduduk->nama = $request->nama;
        $penduduk->nik = $request->nik;
        $penduduk->kk = $request->kk;
        $penduduk->tmp_lahir = $request->tmp_lahir;
        $penduduk->tgl_lahir = $request->tgl_lahir;
        $penduduk->jenkel = $request->jenkel;
        $penduduk->goldar = $request->goldar;
        $penduduk->agama = $request->agama;
        $penduduk->stat_hbkel = $request->stat_hbkel;
        $penduduk->status_kawin = $request->status_kawin;
        $penduduk->pendidikan = $request->pendidikan;
        $penduduk->pekerjaan = $request->pekerjaan;
        $penduduk->nama_ibu = $request->nama_ibu;
        $penduduk->nama_ayah = $request->nama_ayah;
        $penduduk->alamat = $request->alamat;
        $penduduk->rt = $request->rt;
        $penduduk->rw = $request->rw;
        $penduduk->kelurahan = $request->kelurahan;
        $penduduk->kecamatan = $request->kecamatan;
        $penduduk->kotakab = $request->kotakab;
        $penduduk->propinsi = $request->propinsi;
        $penduduk->status_pend = $request->status_pend;

        $penduduk->save();

        if ($penduduk) {
            return redirect()->back()->with('success', 'Data berhasil Di Simpan');
        }

        return redirect()->back()->with('failed', 'data gagal di Simpan');
    }
    //==END Tambah Data Penduduk==///////////////////////////////////////////////////////////////////////////////////////////


    //==EXPORT DATA PENDUDUK==//////////////////////////////////////////////////////////////////////////////////////////////////////

    public function pendudukExport()
    {
        return Excel::download(new pendudukExport, 'data-Penduduk.xlsx');
    }

    //== END EXPORT DATA PENDUDUK==//////////////////////////////////////////////////////////////////////////////////////////////////////



    //==IMPORT DATA PENDUDUK==//////////////////////////////////////////////////////////////////////////////////////////////////////

    public function pendudukImport(Request $request)
    {
        $import = Excel::import(new pendudukImport, request()->file('importFile'));
        if ($import) {
            return back()->with('success', 'data berhasil di import');
        }
        return back()->with('failed', 'data gagal di import');
    }
    //==END IMPORT DATA PENDUDUK==//////////////////////////////////////////////////////////////////////////////////////////////////////



    //==DELETE DATA PENDUDUK==//////////////////////////////////////////////////////////////////////////////////////////////////////

    public function delete($nik)
    {
        $penduduk = data_penduduk::where('nik', $nik)->first();
        $penduduk->delete();
        if ($penduduk) {
            return redirect()->back()->with('success', 'Data Berhasil dihapus');
        }
        return redirect()->back()->with('failed', 'Data gagal dihapus');
    }
    //== END DELETE DATA PENDUDUK==////////////////////////////////////////////////////////////////////////////////////////////////



    //==EDIT DATA PENDUDUK==//////////////////////////////////////////////////////////////////////////////////////////////////////

    public function update(Request $request, $nik)
    {

        $penduduk = data_penduduk::where('nik', $nik)->first();

        $penduduk->nama = $request->nama;
        $penduduk->nik = $request->nik;
        $penduduk->kk = $request->kk;
        $penduduk->tmp_lahir = $request->tmp_lahir;
        $penduduk->tgl_lahir = $request->tgl_lahir;
        $penduduk->jenkel = $request->jenkel;
        $penduduk->goldar = $request->goldar;
        $penduduk->agama = $request->agama;
        $penduduk->stat_hbkel = $request->stat_hbkel;
        $penduduk->status_kawin = $request->status_kawin;
        $penduduk->pendidikan = $request->pendidikan;
        $penduduk->pekerjaan = $request->pekerjaan;
        $penduduk->nama_ibu = $request->nama_ibu;
        $penduduk->nama_ayah = $request->nama_ayah;
        $penduduk->alamat = $request->alamat;
        $penduduk->rt = $request->rt;
        $penduduk->rw = $request->rw;
        $penduduk->kelurahan = $request->kelurahan;
        $penduduk->kecamatan = $request->kecamatan;
        $penduduk->kotakab = $request->kotakab;
        $penduduk->propinsi = $request->propinsi;
        $penduduk->status_pend = $request->status_pend;

        $penduduk->save();

        if ($penduduk) {
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        }

        return redirect()->back()->with('failed', 'data gagal di Edit');
    }
    //==EDIT DATA PENDUDUK==//////////////////////////////////////////////////////////////////////////////////////////////////////
}