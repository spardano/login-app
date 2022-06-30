<?php

use App\Exports\pendudukExport;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\data_PController;
use App\Http\Controllers\Api\datapendudukController;
use App\Http\Controllers\Api\permintaanController;
use App\Http\Controllers\Api\profileController;
use App\Http\Controllers\Api\SuratNikahController;
use App\Http\Controllers\Api\SuratUmumController;
use App\Http\Controllers\Api\umumController;
use App\Http\Controllers\listpengajuanController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->middleware(['api'])->group(function ($router) {
    //authentication
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('me', [AuthController::class, 'me']);

    //Profile
    Route::post('getprofileUser', [profileController::class, 'getprofileUser']);

    //surat_umum
    Route::post('kode_jabatan', [SuratUmumController::class, 'getKodeJabatan']);
    Route::post('kode_surat', [SuratUmumController::class, 'getKodeSurat']);
    Route::post('submit_surat', [SuratUmumController::class, 'submitSuratUmum']);
    Route::post('getdatasuratumum', [SuratUmumController::class, 'getsuratumum']);
    Route::post('getdatakelurahan', [SuratUmumController::class, 'getkelurahan']);
    Route::post('FileSurat',[SuratUmumController::class, 'FileSurat']);
    Route::post('FileSingleSurat',[SuratUmumController::class, 'FileSingleSurat']);
    

    //list pengajuan saya
    Route::post('datapengajuansaya', [listpengajuanController::class, 'pengajuansaya']);

    //Pejabat
    Route::post('suratkepejabat', [permintaanController::class, 'Suratkepejabat']);

    //kependudukan
    Route::post('submit_penduduk', [datapendudukController::class, 'submitPenduduk']);
    Route::post('getdata_penduduk', [datapendudukController::class, 'getdatapenduduk']);

    //surat_nikah
    Route::post('submit_surat_nikah', [SuratNikahController::class, 'submitSuratNikah']);
    Route::post('getnik_ortulaki', [SuratNikahController::class, 'getNikOrtuLaki']);
    Route::post('getnik_ortupere', [SuratNikahController::class, 'getNikOrtuPere']);
    Route::post('surat_nikah', [SuratNikahController::class, 'getSuratNikah']);
    Route::post('getdatasuratnikah', [SuratNikahController::class, 'getdatasuratnikah']);
});

// Route::get('/penduduk', dataPController::class, 'indeks');