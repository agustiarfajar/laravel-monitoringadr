<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PrintController;

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

#Route::get('/', function () {
#    return view('user.status');
#});


Route::get('/', [HomeController::class, 'main']);

Route::get('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'regist']);
Route::get('/faq', [HomeController::class, 'faq']);

Route::get('/dashboard', [HomeController::class, 'dashboard']);
Route::get('/status-pengiriman', [HomeController::class, 'status']);
Route::get('/userfaq', [HomeController::class, 'userfaq']);

Route::get('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/adminstatus', [AdminController::class, 'adminstatus']);
Route::post('/filter-pengiriman', [AdminController::class, 'filter_pengiriman']);
Route::get('/adminfaq', [AdminController::class, 'adminfaq']);

Route::get('/surat-jalan', [AdminController::class, 'suratjalan']);
Route::get('/daftar-barang', [AdminController::class, 'daftarbarang']);
Route::get('/edit-ekspedisi', [AdminController::class, 'editekspedisi']);

//Route::get('/tambah-pengiriman', [AdminController::class, 'addpengiriman']);

Route::get('/tambah-pengiriman-site', [FormController::class, 'index'])->name('form.index');
Route::post('/simpan-pengiriman-site', [FormController::class, 'save_barang']);

Route::get('/tambah-pengiriman', [FormController::class, 'index2'])->name('form.index2');
Route::post('/simpan-pengiriman-ho', [FormController::class, 'simpan_pengiriman_ho']);
Route::post('/get-item', [FormController::class, 'get_item']);
Route::get('/detail/pengiriman-ho/{id}', [AdminController::class, 'detail_pengiriman_ho']);
Route::get('/reset-form', [FormController::class, 'reset'])->name('form.reset');
Route::get('/form', [FormController::class, 'form'])->name('form.first');

Route::delete('/delete-data/{id}', [FormController::class, 'deleteData'])->name('data.delete');

Route::get('/data', [DataController::class, 'index'])->name('data.index');

Route::get('/tambahitem', [AdminController::class, 'additem']);
Route::post('/simpan-item', [AdminController::class, 'simpan_item']);
Route::get('/edit-item/{id}', [AdminController::class, 'edit_item']);
Route::post('/update-item/{id}', [AdminController::class, 'update_item']);
Route::get('/delete-item/{id}', [AdminController::class, 'delete_item']);
Route::get('/detail/pengiriman-site/{id}', [AdminController::class, 'detail_pengiriman_site']);

// Laporan
Route::get('/laporan', [AdminController::class, 'laporan']);
Route::get('/export-laporan-kpi', [AdminController::class, 'exportDataToCsv']);

// Update status pengiriman pemasok
Route::post('/update-status/kirim/{id}', [AdminController::class, 'update_status_kirim']);
Route::post('/update-status/terima/{id}', [AdminController::class, 'update_status_terima']);
Route::post('/update-status/batal/{id}', [AdminController::class, 'update_status_batal_pemasok']);
// Update status pengiriman HO
Route::post('/update-status-ho/kirim/{id}', [AdminController::class, 'update_status_kirim_ho']);
Route::post('/update-status-ho/terima/{id}', [AdminController::class, 'update_status_terima_ho']);
Route::post('/update-status-ho/batal/{id}', [AdminController::class, 'update_status_batal_ho']);
//Route::post('/post', [FormController::class, 'post'])->name('admin.status');

// Perusahaan
Route::get('/perusahaan', [AdminController::class, 'view_perusahaan']);
Route::post('/perusahaan/save', [AdminController::class, 'save_perusahaan']);
Route::post('/perusahaan/update/{id}', [AdminController::class, 'update_perusahaan']);
Route::get('/perusahaan/delete/{id}', [AdminController::class, 'delete_perusahaan']);

// Ekspedisi
Route::get('/ekspedisi', [AdminController::class, 'view_ekspedisi']);
Route::post('/ekspedisi/save', [AdminController::class, 'save_ekspedisi']);
Route::post('/ekspedisi/update/{id}', [AdminController::class, 'update_ekspedisi']);
Route::get('/ekspedisi/delete/{id}', [AdminController::class, 'delete_ekspedisi']);

// Dashboard periode
Route::post('/sisa-barang-ho-update/periode', [AdminController::class, 'update_sisa_barang_ho_periode']);
Route::post('/barang-masuk-update/periode', [AdminController::class, 'update_barang_masuk']);
Route::post('/barang-keluar-update/periode', [AdminController::class, 'update_barang_keluar']);
Route::post('/surat-jalan-update/periode', [AdminController::class, 'update_surat_jalan_periode']);
Route::post('/barang-aging-update/periode', [AdminController::class, 'update_barang_aging_periode']);
Route::post('/belum-kirim-pemasok-update/periode', [AdminController::class, 'update_belum_kirim_pemasok_periode']);
Route::post('/belum-terima-site-update/periode', [AdminController::class, 'update_belum_terima_site_periode']);
Route::post('/batal-proses-update/periode', [AdminController::class, 'update_batal_proses_periode']);
Route::post('/chart-update/periode', [AdminController::class, 'update_chart_periode']);
Route::post('/chart-pengiriman-update/periode', [AdminController::class, 'update_chart_pengiriman_periode']);

Route::get('/print/{id}', [PrintController::class, 'print']);
Route::get('/printho/{id}', [PrintController::class, 'print_ho']);