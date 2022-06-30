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


// Route::view('/', 'starter')->name('starter');
Route::get('large-compact-sidebar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'compact']);
    return view('dashboard.dashboardv1');
})->name('compact');

Route::get('large-sidebar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'normal']);
    return view('dashboard.dashboardv1');
})->name('normal');

Route::get('horizontal-bar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'horizontal']);
    return view('dashboard.dashboardv1');
})->name('horizontal');

Route::get('vertical/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'vertical']);
    return view('dashboard.dashboardv1');
})->name('vertical');


Route::view('dashboard/dashboard1', 'dashboard.dashboardv1')->name('dashboard_version_1');
Route::view('dashboard/dashboard2', 'dashboard.dashboardv2')->name('dashboard_version_2');
Route::view('dashboard/dashboard3', 'dashboard.dashboardv3')->name('dashboard_version_3');
Route::view('dashboard/dashboard4', 'dashboard.dashboardv4')->name('dashboard_version_4');

// uiKits
Route::view('uikits/alerts', 'uiKits.alerts')->name('alerts');
Route::view('uikits/accordion', 'uiKits.accordion')->name('accordion');
Route::view('uikits/buttons', 'uiKits.buttons')->name('buttons');
Route::view('uikits/badges', 'uiKits.badges')->name('badges');
Route::view('uikits/bootstrap-tab', 'uiKits.bootstrap-tab')->name('bootstrap-tab');
Route::view('uikits/carousel', 'uiKits.carousel')->name('carousel');
Route::view('uikits/collapsible', 'uiKits.collapsible')->name('collapsible');
Route::view('uikits/lists', 'uiKits.lists')->name('lists');
Route::view('uikits/pagination', 'uiKits.pagination')->name('pagination');
Route::view('uikits/popover', 'uiKits.popover')->name('popover');
Route::view('uikits/progressbar', 'uiKits.progressbar')->name('progressbar');
Route::view('uikits/tables', 'uiKits.tables')->name('tables');
Route::view('uikits/tabs', 'uiKits.tabs')->name('tabs');
Route::view('uikits/tooltip', 'uiKits.tooltip')->name('tooltip');
Route::view('uikits/modals', 'uiKits.modals')->name('modals');
Route::view('uikits/NoUislider', 'uiKits.NoUislider')->name('NoUislider');
Route::view('uikits/cards', 'uiKits.cards')->name('cards');
Route::view('uikits/cards-metrics', 'uiKits.cards-metrics')->name('cards-metrics');
Route::view('uikits/typography', 'uiKits.typography')->name('typography');

// extra kits
Route::view('extrakits/dropDown', 'extraKits.dropDown')->name('dropDown');
Route::view('extrakits/imageCroper', 'extraKits.imageCroper')->name('imageCroper');
Route::view('extrakits/loader', 'extraKits.loader')->name('loader');
Route::view('extrakits/laddaButton', 'extraKits.laddaButton')->name('laddaButton');
Route::view('extrakits/toastr', 'extraKits.toastr')->name('toastr');
Route::view('extrakits/sweetAlert', 'extraKits.sweetAlert')->name('sweetAlert');
Route::view('extrakits/tour', 'extraKits.tour')->name('tour');
Route::view('extrakits/upload', 'extraKits.upload')->name('upload');


// Apps
Route::view('apps/invoice', 'apps.invoice')->name('invoice');
Route::view('apps/inbox', 'apps.inbox')->name('inbox');
Route::view('apps/chat', 'apps.chat')->name('chat');
Route::view('apps/calendar', 'apps.calendar')->name('calendar');
Route::view('apps/task-manager-list', 'apps.task-manager-list')->name('task-manager-list');
Route::view('apps/task-manager', 'apps.task-manager')->name('task-manager');
Route::view('apps/toDo', 'apps.toDo')->name('toDo');
Route::view('apps/ecommerce/products', 'apps.ecommerce.products')->name('ecommerce-products');
Route::view('apps/ecommerce/product-details', 'apps.ecommerce.product-details')->name('ecommerce-product-details');
Route::view('apps/ecommerce/cart', 'apps.ecommerce.cart')->name('ecommerce-cart');
Route::view('apps/ecommerce/checkout', 'apps.ecommerce.checkout')->name('ecommerce-checkout');


Route::view('apps/contacts/lists', 'apps.contacts.lists')->name('contacts-lists');
Route::view('apps/contacts/contact-details', 'apps.contacts.contact-details')->name('contact-details');
Route::view('apps/contacts/grid', 'apps.contacts.grid')->name('contacts-grid');
Route::view('apps/contacts/contact-list-table', 'apps.contacts.contact-list-table')->name('contact-list-table');

// forms
Route::view('forms/basic-action-bar', 'forms.basic-action-bar')->name('basic-action-bar');
Route::view('forms/multi-column-forms', 'forms.multi-column-forms')->name('multi-column-forms');
Route::view('forms/smartWizard', 'forms.smartWizard')->name('smartWizard');
Route::view('forms/tagInput', 'forms.tagInput')->name('tagInput');
Route::view('forms/forms-basic', 'forms.forms-basic')->name('forms-basic');
Route::view('forms/form-layouts', 'forms.form-layouts')->name('form-layouts');
Route::view('forms/form-input-group', 'forms.form-input-group')->name('form-input-group');
Route::view('forms/form-validation', 'forms.form-validation')->name('form-validation');
Route::view('forms/form-editor', 'forms.form-editor')->name('form-editor');

// Charts
Route::view('charts/echarts', 'charts.echarts')->name('echarts');
Route::view('charts/chartjs', 'charts.chartjs')->name('chartjs');
Route::view('charts/apexLineCharts', 'charts.apexLineCharts')->name('apexLineCharts');
Route::view('charts/apexAreaCharts', 'charts.apexAreaCharts')->name('apexAreaCharts');
Route::view('charts/apexBarCharts', 'charts.apexBarCharts')->name('apexBarCharts');
Route::view('charts/apexColumnCharts', 'charts.apexColumnCharts')->name('apexColumnCharts');
Route::view('charts/apexRadialBarCharts', 'charts.apexRadialBarCharts')->name('apexRadialBarCharts');
Route::view('charts/apexRadarCharts', 'charts.apexRadarCharts')->name('apexRadarCharts');
Route::view('charts/apexPieDonutCharts', 'charts.apexPieDonutCharts')->name('apexPieDonutCharts');
Route::view('charts/apexSparklineCharts', 'charts.apexSparklineCharts')->name('apexSparklineCharts');
Route::view('charts/apexScatterCharts', 'charts.apexScatterCharts')->name('apexScatterCharts');
Route::view('charts/apexBubbleCharts', 'charts.apexBubbleCharts')->name('apexBubbleCharts');
Route::view('charts/apexCandleStickCharts', 'charts.apexCandleStickCharts')->name('apexCandleStickCharts');
Route::view('charts/apexMixCharts', 'charts.apexMixCharts')->name('apexMixCharts');

// datatables
Route::view('datatables/basic-tables', 'datatables.basic-tables')->name('basic-tables');

// sessions
Route::view('sessions/signIn', 'sessions.signIn')->name('signIn');
Route::view('sessions/signUp', 'sessions.signUp')->name('signUp');
Route::view('sessions/forgot', 'sessions.forgot')->name('forgot');

// widgets
Route::view('widgets/card', 'widgets.card')->name('widget-card');
Route::view('widgets/statistics', 'widgets.statistics')->name('widget-statistics');
Route::view('widgets/list', 'widgets.list')->name('widget-list');
Route::view('widgets/app', 'widgets.app')->name('widget-app');
Route::view('widgets/weather-app', 'widgets.weather-app')->name('widget-weather-app');

// others
Route::view('others/notFound', 'others.notFound')->name('notFound');
Route::view('others/user-profile', 'others.user-profile')->name('user-profile');
Route::view('others/starter', 'starter')->name('starter');
Route::view('others/faq', 'others.faq')->name('faq');
Route::view('others/pricing-table', 'others.pricing-table')->name('pricing-table');
Route::view('others/search-result', 'others.search-result')->name('search-result');

require __DIR__ . '/auth.php';