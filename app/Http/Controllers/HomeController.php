<?php

namespace App\Http\Controllers;

use App\Models\data_penduduk;
use App\Models\kel_desa;
use App\Models\KodeJabatan;
use App\Models\surat_umum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Home';
        if (Auth::user()->id_kel_desa != 52) {
            $users = User::where('id_kel_desa', Auth::user()->id_kel_desa)->count();
            $kelurahan = kel_desa::count();
            $suratumum = surat_umum::where('id_kel', Auth::user()->id_kel_desa)->count();
            $penduduk = data_penduduk::where('kelurahan', Auth::user()->id_kel_desa)->count();
            $suratkepejabat = surat_umum::with('penduduk')->where('id_kel', Auth::user()->id_kel_desa)->where('status_surat', '1')->count();
            $pejabat = KodeJabatan::whereHas('jab_kel', function ($query) {
                $query->where('id_kel', Auth::user()->id_kel_desa);
            })->count();
        } else {
            $suratumum = surat_umum::count();
            $pejabat = KodeJabatan::count();
            $penduduk = data_penduduk::count();
            $kelurahan = kel_desa::count();
            $users = User::count();
            $suratkepejabat = surat_umum::with('penduduk')->where('id_kel', Auth::user()->id_kel_desa)->where('status_surat', '1')->count();
        }


        return view('admin.home.home', [
            'title' => $title,
            'suratumum' => $suratumum,
            'pejabat' => $pejabat,
            'penduduk' => $penduduk,
            'kelurahan' => $kelurahan,
            'users' => $users,
            'suratkepejabat' => $suratkepejabat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}