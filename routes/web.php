<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\klasifikasiController;
use App\Http\Controllers\othersController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\pendudukController;
use App\Http\Controllers\PengajuannikahController;
use App\Http\Controllers\PengajuanumumController;
use App\Http\Controllers\PenomoranSuratController;
use App\Http\Controllers\SignaturePadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home
Route::get('/', [HomeController::class, 'index'])->middleware('auth');

//penomoran surat
// Route::prefix('penomoransurat')->group(function () {
//     Route::get('index', [PenomoranSuratController::class, 'index'])->name('penomoransurat');
//     Route::post('store', [PenomoranSuratController::class, 'store'])->name('penomoran_surat.store');
// });


//Home Pejabat
Route::get('Suratkepejabat', [PengajuanumumController::class, 'Suratkepejabat'])->name('Suratkepejabat');


//Klasifikasi Surat
Route::get('klasifikasi_surat', [klasifikasiController::class, 'index'])->name('klasifikasi_surat');
Route::Post('klasifikasi_surat/store', [klasifikasiController::class, 'store'])->name('klasifikasi_surat.store');
Route::Post('klasifikasi_surat/edit/{id}', [klasifikasiController::class, 'edit'])->name('klasifikasi_surat.edit');
Route::get('klasifikasi_surat/delete/{id}', [klasifikasiController::class, 'delete'])->name('klasifikasi_surat.delete');

//Penomoran Surat
Route::get('penomoran_surat', [PenomoranSuratController::class, 'index'])->name('penomoran_surat');
Route::post('penomoran_surat/store', [PenomoranSuratController::class, 'store'])->name('penomoran_surat.store');
Route::put('penomoran_surat/update', [PenomoranSuratController::class, 'update'])->name('penomoran_surat.update');
Route::delete('penomoran_surat/delete/{id}', [PenomoranSuratController::class, 'delete'])->name('penomoran_surat.delete');

//USERS
Route::get('users', [UserController::class, 'index'])->name('users');
Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::post('users/update/{id}', [UserController::class, 'update'])->name('users.update');

//Jabatan
Route::prefix('pejabat')->group(function () {
    Route::get('', [PejabatController::class, 'index'])->name('pejabat');
    Route::post('tambah', [PejabatController::class, 'tambah'])->name('pejabat.tambah');
    Route::put('/edit', [PejabatController::class, 'edit'])->name('pejabat.edit');
    Route::get('delete/{id}', [PejabatController::class, 'delete'])->name('pejabat.delete');
});

//Surat umum
Route::get('suratumum', [PengajuanumumController::class, 'index'])->name('suratumum');
Route::get('detailsurat/{id}', [PengajuanumumController::class, 'detailsurat'])->name('detailsurat');
Route::get('exportpdf/{id}', [PengajuanumumController::class, 'exportpdf'])->name('exportpdf');
Route::get('detailsurat/getnomorotomatis/{id}', [PengajuanumumController::class, 'getPenomoranOtomatis']);
Route::get('statussurat/{id}', [PengajuanumumController::class, 'statussurat'])->name('statussurat  ');
Route::post('updatedetailsurat/{id}', [PengajuanumumController::class, 'updatedetailsurat'])->name('updatedetailsurat');
Route::get('suratditerima/{id}', [PengajuanumumController::class, 'suratditerima'])->name('suratditerima');
Route::get('suratdikembalikan/{id}', [PengajuanumumController::class, 'suratdikembalikan'])->name('suratdikembalikan');
Route::get('suratditolak/{id}', [PengajuanumumController::class, 'suratditolak'])->name('suratditolak');


//Surat Nikah
Route::get('suratnikah', [PengajuannikahController::class, 'index'])->name('suratnikah');
Route::get('detailsuratnikah', [PengajuannikahController::class, 'detailsuratnikah'])->name('detailsuratnikah');
Route::get('pdfnikah/{nik_calon}', [PengajuannikahController::class, 'pdfnikah'])->name('pdfnikah');

//Penduduk
Route::get('datapenduduks', [pendudukController::class, 'index'])->name('penduduk');
Route::post('datapenduduk/update/{nik}', [pendudukController::class, 'update'])->name('datapenduduk.update');
Route::get('datapenduduk/delete/{nik}', [pendudukController::class, 'delete'])->name('datapenduduk.delete');
Route::get('pendudukexport', [pendudukController::class, 'pendudukExport'])->name('pendudukExport');
Route::Post('pendudukImport', [pendudukController::class, 'pendudukImport'])->name('pendudukImport');
Route::Post('datapenduduk/store', [pendudukController::class, 'store'])->name('datapenduduk.store');

//tanda tangan
Route::get('signaturepad', [SignaturePadController::class, 'index'])->name('ttd');
Route::post('signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');

Route::prefix('others')->group(function () {
    Route::get('/unauthorized', [othersController::class, 'unauthorized'])->name('others.unauthorized');
});

//dashboard
Route::get('/dashboard', function () {
    $role = config('roles.models.role')::where('name', '=', 'Admin')->first();  //choose the default role upon user creation.
    auth()->user()->attachRole($role);
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



// sessions
Route::view('sessions/signIn', 'sessions.signIn')->name('signIn');
Route::view('sessions/signUp', 'sessions.signUp')->name('signUp');
Route::view('sessions/forgot', 'sessions.forgot')->name('forgot');


require __DIR__ . '/auth.php';