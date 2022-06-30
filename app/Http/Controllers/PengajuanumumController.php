<?php

namespace App\Http\Controllers;

//seluruh Models yang digunakan 

use App\Models\data_penduduk;
use App\Models\KodeJabatan;
use App\Models\penomoran_surat;
use App\Models\surat_umum;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;


class PengajuanumumController extends Controller
{
    public function __construct()
    {
        $this->middleware('izin.suratumum');
    }

    //==INDEX==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index(Request $request)
    {

        $userLogin = Auth::user(); // tampung data user sedang login
        //tampung data dari table user dimana id nya sama dengan id user sedang login
        $user = User::where('id', $userLogin->id)->first();
        $jabatan = KodeJabatan::whereHas('jab_kel', function ($query) {
            $query->where('id_kel', Auth::user()->id_kel_desa);
        })->get();

        if ($user->hasRole(['adminkelurahan'])) {
            $suratumum = surat_umum::with('penduduk')->with('KlasifikasiSurat')->with('kodejabatan')->where('id_kel', Auth::user()->id_kel_desa)->get();
        } elseif ($user->hasRole(['admin'])) {
            $suratumum = surat_umum::with('penduduk')->with('KlasifikasiSurat')->get();
        }

        // kembalikan nilai atau data ke halaman view index
        return view('admin.suratumum.index', [
            "title" => "SingelPost",
            "data" => $suratumum,
            "jabatan" => $jabatan
        ]);
    }
    //==END==INDEX==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    //==DETAIL SURAT UMUM==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // function untuk menampilkan detail dari surat umum berdasarkan id surat
    public function detailsurat(Request $request, $id)
    {
        // mengambil data penduduk dan klasifikasi surat dimana id surat sama dengan id surat umum 
        $data = surat_umum::where('id', $id)->with('penduduk')->with('KlasifikasiSurat')->with('kodejabatan')->first();

        //ambil data kk dimana nik data_penduduk sama dengan nik yang ada di surat umum
        $no_kk = data_penduduk::select('kk')->where('nik', $data->nik)->first();

        // ambil data penduduk dimana kk di data penduduk sama dengan no_kk si pengaju surat 
        $keluarga = data_penduduk::where('kk', $no_kk->kk)->get();


        if (Auth::user()->id_kel_desa != 52) //kondisi user bukan admin
        {
            // ambil jabatan sesuai dengan id kelurahan dimana id kelurahan sama dengan user
            $jabatan = KodeJabatan::whereHas('jab_kel', function ($query) {
                $query->where('id_kel', Auth::user()->id_kel_desa);
            })->get();
        } else // kondisi user adalah admin
        {
            // ambil seluruh data jabatan
            $jabatan = KodeJabatan::get();
        }
        // kembalikan nilai diatas ke halaman view detail surat
        return view('admin.suratumum.detailsurat', [
            "data" => $data,
            "datakel" => $keluarga,
            "jabatan" => $jabatan
        ]);
    }
    //==END==DETAIL SURAT UMUM==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //=UPDATE NO_SURAT UMUM==///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updatedetailsurat(Request $request, $id)
    {
        $surat = surat_umum::where('id', $id)->first();
        $surat->nomor_surat = $request->no_surat;
        $surat->save();
        if ($surat) {
            $surat->update([
                'nomor_surat' => $request->no_surat,
                'kode_jabatan' => $request->kode_jabatan,
                'status_surat' => 1
            ]);
            return redirect()->back()->with('success', 'Data berhasil diterima');
        }
        return redirect()->back()->with('failed', 'Data gagal diterima atau surat tidak ada');
    }
    //==END==UPDATE NO_SURAT UMUM==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //==PENOMORAN OTOMATIS SURAT==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * method untuk mendapatkan penomoran otomatis
     * parameter id_klasifikasi_surat
     * return response json
     */
    public function getPenomoranOtomatis(Request $request, $id_klasifikasi_surat)
    {
        $penomoran = penomoran_surat::with('kel_desa')->with('klasifikasi_surat')->where('id_jenis_surat', $id_klasifikasi_surat)->where('id_kel_desa', Auth::user()->id_kel_desa)->first();

        if ($penomoran) {
            return response()->json([
                "status" => true,
                "penomoran" => $penomoran
            ]);
        }

        return response()->json([
            "status" => false
        ]);
    }
    //==END PENOMORAN OTOMATIS==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    //==EXPORT PDF==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * method untuk export tampilan menjadi PDF
     * 
     * return response json
     */
    public function exportpdf(Request $request, $id)
    {
        // ambil data surat umum dimana id surat umum sama dengan parameter id surat  
        // dengan data penduduk dan data klasifikasi surat dan getkodeDesa
        $data = surat_umum::where('id', $id)->with('penduduk')->with('KlasifikasiSurat')->with('getkodeDesa')->first();

        //ambil data kk dimana nik data_penduduk sama dengan nik yang ada di surat umum
        $no_kk = data_penduduk::select('kk')->where('nik', $data->nik)->first();

        // ambil data penduduk dimana kk di data penduduk sama dengan no_kk si pengaju surat 
        $keluarga = data_penduduk::where('kk', $no_kk->kk)->get();

        $userLogin = Auth::user(); // tampung data user sedang login
        //tampung data dari table user dimana id nya sama dengan id user sedang login
        $user = User::where('id', $userLogin->id)->first();

        if ($user->hasRole(['pejabat'])) {
            $ttd = KodeJabatan::where('nik', Auth::user()->nik)->first();
        } elseif ($user->hasRole(['adminkelurahan'])) {
            $ttd = KodeJabatan::where('kode_jabatan', $data->kode_jabatan)->first();
        }

        $stringNamaView = ''; // variabel baru dengan nilai defauld null

        if ($data['kode_surat'] === '011') { //kondisi jika kode surat sama dengan 011
            //ubah nilai dari variabel stringview = surat tidak mampu
            $stringNamaView = 'surattidakmampu';
        } else if ($data['kode_surat'] === '300') { //kondisi jika kode surat sama dengan 012
            //ubah nilai dari variabel stringview = surat berkelakuan baik
            $stringNamaView = "suratberkelakuanbaik";
        } else if ($data['kode_surat'] === '014') { //kondisi jika kode surat sama dengan 014
            //ubah nilai dari variabel stringview = surat keterangan lain
            $stringNamaView = "suratketeranganlain";
        } else if ($data['kode_surat'] === '013') { //kondisi jika kode surat sama dengan 013
            //ubah nilai dari variabel stringview = surat belum pernah menikah
            $stringNamaView = "suratbelumpernahmenikah";
        }

        // tampung seluruh data view kedalam variabel $pdf

        $pdf = PDF::loadview('admin.suratumum.' . $stringNamaView, [
            "data" => $data,
            "datakel" => $keluarga,
            "TTD" => $ttd,
        ])->setPaper('A4', 'potrait'); // seting kertas default yang digunakan
        //kembalikan seluruh data pada file load pdf
        return $pdf->stream();
    }

    //==END EXPORT PDF==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //==Surat Kepejabat==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Suratkepejabat(Request $request)
    {
        $jabatan = KodeJabatan::where('nik', Auth::user()->nik)->first();
        $data = surat_umum::with('penduduk')->with('kodejabatan')->where('kode_jabatan', $jabatan->kode_jabatan)->where('id_kel', Auth::user()->id_kel_desa)->where('status_surat', "!=", 0)->get();

        return view('admin.pejabat.suratumum', [
            'datasurat' => $data
        ]);
    }

    //==END Surat Kepejabat==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    //==Surat Ditema==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function suratditerima(Request $request, $id)
    {
        $data = surat_umum::where('id', $id)->with('penduduk')->with('KlasifikasiSurat')->with('getkodeDesa')->first();

        //ambil data kk dimana nik data_penduduk sama dengan nik yang ada di surat umum
        $no_kk = data_penduduk::select('kk')->where('nik', $data->nik)->first();

        // ambil data penduduk dimana kk di data penduduk sama dengan no_kk si pengaju surat 
        $keluarga = data_penduduk::where('kk', $no_kk->kk)->get();


        $ttd = KodeJabatan::where('nik', Auth::user()->nik)->first();

        $file_name = $data->nik . $data->kode_surat;

        if ($data) {
            $data->update([
                'status_surat' => 2,
                'document' => $file_name
            ]);

            $stringNamaView = ''; // variabel baru dengan nilai defauld null

            if ($data['kode_surat'] === '011') { //kondisi jika kode surat sama dengan 011
                //ubah nilai dari variabel stringview = surat tidak mampu
                $stringNamaView = 'surattidakmampu';
            } else if ($data['kode_surat'] === '300') { //kondisi jika kode surat sama dengan 012
                //ubah nilai dari variabel stringview = surat berkelakuan baik
                $stringNamaView = "suratberkelakuanbaik";
            } else if ($data['kode_surat'] === '014') { //kondisi jika kode surat sama dengan 014
                //ubah nilai dari variabel stringview = surat keterangan lain
                $stringNamaView = "suratketeranganlain";
            } else if ($data['kode_surat'] === '013') { //kondisi jika kode surat sama dengan 013
                //ubah nilai dari variabel stringview = surat belum pernah menikah
                $stringNamaView = "suratbelumpernahmenikah";
            }

            // tampung seluruh data view kedalam variabel $pdf

            $pdf = PDF::loadview('admin.suratumum.' . $stringNamaView, [
                "data" => $data,
                "datakel" => $keluarga,
                "TTD" => $ttd
            ])->save('dokumen/' . $file_name . '.pdf')->setPaper('A4', 'potrait'); // seting kertas default yang digunakan
            //kembalikan seluruh data pada file load pdf
            $pdf->stream();

            return redirect()->back()->with('success', 'Data berhasil diterima');
        }

        return redirect()->back()->with('failed', 'Data gagal diterima atau surat tidak ada');
    }

    //==END Surat Ditema==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //==Surat Dikembalikan ==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function suratdikembalikan(Request $request, $id)
    {
        $status = surat_umum::where('id', $id)->first();
        $staussekarang = $status->status_surat;
        if ($staussekarang == $status->status_surat) {
            $staussekarang = surat_umum::where('id', $id)->update([
                'status_surat' => 3
            ]);
        }
        return redirect()->back();
    }

    //==END Surat Dikembalikan==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //==Surat Ditolak ==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function suratditolak(Request $request, $id)
    {
        $status = surat_umum::where('id', $id)->first();
        $staussekarang = $status->status_surat;
        if ($staussekarang == $status->status_surat) {
            $staussekarang = surat_umum::where('id', $id)->update([
                'status_surat' => 4
            ]);

            return redirect()->back()->with('success', 'Surat Berhasil Ditolak');
        }
        return redirect()->back()->with('failed', 'Surat Gagal Ditolak');
    }

    //==END Surat tolak==//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}