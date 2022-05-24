<?php

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
//live-msg//
Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'index']);
Route::get('messagesfetch/{id}', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
Route::post('messages', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
Route::get('room/{id}', [App\Http\Controllers\ChatsController::class, 'fetchRoom']);
Route::get('room/del/{room_id}', [App\Http\Controllers\ChatsController::class, 'delRoom']);
Route::get('jasa/{id}', [App\Http\Controllers\ChatsController::class, 'fetchjasa']);
Route::get('createroom/{jenis}/{tipejasa}/{jasa_id}', [App\Http\Controllers\ChatsController::class, 'createRoom']);
//coba//
Route::get('public/katalog/detail/{id}', [App\Http\Controllers\HomeController::class, 'viewdetailkatalogpublic'])->name('viewdetailkatalogpublic');

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home1');
Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('homeadmin');


//Admin//
  //profile//
Route::get('/admin/profile', [App\Http\Controllers\AdminController::class, 'viewprofile'])->name('viewprofileadmin'); 
Route::post('/admin/add', [App\Http\Controllers\AdminController::class, 'addadmin'])->name('addadmin');
    //katalog//
Route::post('/admin/katalog/save', [App\Http\Controllers\AdminController::class, 'setkatalog'])->name('setkatalog');
Route::post('/admin/katalog/img/add', [App\Http\Controllers\AdminController::class, 'addimgkatalog'])->name('addimgkatalog');
Route::get('/admin/katalog/img/del/{id}/{img}', [App\Http\Controllers\AdminController::class, 'delimgkatalog'])->name('delimgkatalog');
Route::post('/admin/katalog/edit', [App\Http\Controllers\AdminController::class, 'editkatalog'])->name('editkatalog');
Route::post('/admin/katalog/del', [App\Http\Controllers\AdminController::class, 'delkatalog'])->name('delkatalog');
Route::get('/admin/katalog/detail/{id}', [App\Http\Controllers\AdminController::class, 'viewadmindetailkatalog'])->name('viewadmindetailkatalog');
Route::get('/admin/katalog/detail/del/{id}/{id_kat}/{tipe}', [App\Http\Controllers\AdminController::class, 'delkatalogukuran'])->name('delkatalogukuran');
Route::get('/admin/katalog/detail/create/{id}/{tipe}', [App\Http\Controllers\AdminController::class, 'createdetailkatalog'])->name('createdetailkatalog');
Route::get('/admin/katalog/detail/edit/detail/{id}', [App\Http\Controllers\AdminController::class, 'vieweditdetailkatalog'])->name('vieweditdetailkatalog');
Route::post('/admin/katalog/detail/edit/detail/save', [App\Http\Controllers\AdminController::class, 'saveeditdetailkatalog'])->name('adminsaveeditdetailkatalog');
    //sampling//
Route::post('/admin/slotsampling/save', [App\Http\Controllers\AdminController::class, 'saveslot'])->name('saveslot');
Route::post('/admin/saveeditslot', [App\Http\Controllers\AdminController::class, 'saveeditslot'])->name('saveeditslot');
Route::get('/admin/slotsampling', [App\Http\Controllers\AdminController::class, 'viewslotsampling'])->name('viewslotsampling');
Route::get('/admin/slot/del/{id}', [App\Http\Controllers\AdminController::class, 'delslot'])->name('delslot');
Route::get('/admin/editslot/{id}', [App\Http\Controllers\AdminController::class, 'vieweditslot'])->name('vieweditslot');
Route::get('/admin/listsampling/', [App\Http\Controllers\AdminController::class, 'viewslistsampling'])->name('viewslistsampling');
Route::get('/admin/listsampling/del/{id}', [App\Http\Controllers\AdminController::class, 'delS'])->name('admindelS');
Route::get('/admin/editsampling/{id}', [App\Http\Controllers\AdminController::class, 'vieweditsampling'])->name('adminvieweditsampling');
Route::post('/admin/editsampling/saveedit', [App\Http\Controllers\AdminController::class, 'saveeditS'])->name('adminsaveeditS');
Route::post('/admin/sampling/edit/save', [App\Http\Controllers\AdminController::class, 'saveeditsampkat'])->name('adminsaveeditsampkat');
Route::post('/admin/editsampling/uploadimg', [App\Http\Controllers\AdminController::class, 'uploadimg'])->name('adminuploadimg');
Route::post('/admin/editsampling/delimg', [App\Http\Controllers\AdminController::class, 'delimg'])->name('admindelimg');
Route::post('/admin/editsampling/statusSampling', [App\Http\Controllers\AdminController::class, 'statusSampling'])->name('statusSampling');
Route::post('/admin/listsampling/tgljadi', [App\Http\Controllers\AdminController::class, 'tgljadi'])->name('tgljadi');
    //produksi//
Route::get('/admin/slotproduksi', [App\Http\Controllers\AdminController::class, 'viewslotproduksi'])->name('viewslotproduksi');
Route::post('/admin/slotproduksi/save', [App\Http\Controllers\AdminController::class, 'saveslotP'])->name('saveslotP');
Route::post('/admin/slotproduksi/saveedit', [App\Http\Controllers\AdminController::class, 'saveeditslotP'])->name('saveeditslotP');
Route::get('/admin/editslotproduksi/{id}', [App\Http\Controllers\AdminController::class, 'vieweditslotproduksi'])->name('vieweditslotproduksi');
Route::get('/admin/listproduksi', [App\Http\Controllers\AdminController::class, 'viewslistproduksi'])->name('viewslistproduksi');
route::get('/admin/produksi/edit/{id}', [App\Http\Controllers\AdminController::class, 'vieweditproduksi'])->name('admineditproduksi');
Route::get('/admin/produksi/edit/detail/{id}', [App\Http\Controllers\AdminController::class, 'vieweditdetailprod'])->name('adminvieweditdetailprod');
Route::post('/admin/produksi/edit/detail/save', [App\Http\Controllers\AdminController::class, 'saveeditdetailprod'])->name('adminsaveeditdetailprod');
Route::post('/admin/produksi/edit/save', [App\Http\Controllers\AdminController::class, 'saveeditprod'])->name('adminsaveeditprod');
Route::post('/admin/editproduksi/statusProduksi', [App\Http\Controllers\AdminController::class, 'statusprod'])->name('statusprod');
    //konsul//
Route::get('/admin/setjadwal', [App\Http\Controllers\AdminController::class, 'viewformtambahkonsul'])->name('viewformtambahkonsul');
Route::get('/admin/setjadwal/delete/{id}', [App\Http\Controllers\AdminController::class, 'delkonsul'])->name('delkonsul');
Route::post('/admin/setjadwal/save', [App\Http\Controllers\AdminController::class, 'tambahkonsul'])->name('tambahkonsul');
Route::post('/admin/addlink/save', [App\Http\Controllers\AdminController::class, 'addlink'])->name('addlink');
    //invoice//
Route::post('/admin/tambahinvc', [App\Http\Controllers\AdminController::class, 'tambahinvoice'])->name('tambahinvoice');
Route::get('/admin/invc/{id}/{jns}', [App\Http\Controllers\AdminController::class, 'lihatinvoicesampling'])->name('lihatinvoicesampling');
Route::get('/admin/invcd/{id}/{jns}', [App\Http\Controllers\AdminController::class, 'lihatdetailinvoice'])->name('lihatdetailinvoice');
Route::post('/admin/invc/additem', [App\Http\Controllers\AdminController::class, 'addinvoice'])->name('addinvoice');
Route::post('/admin/invc/delinvoice', [App\Http\Controllers\AdminController::class, 'delinvoice'])->name('delinvoice');
Route::post('/admin/invc/verifbuktibyr', [App\Http\Controllers\AdminController::class, 'verifbuktibyr'])->name('verifbuktibyr');
Route::post('/admin/invc/pdf', [App\Http\Controllers\AdminController::class, 'generateinvoicesampling'])->name('generateinvoicesampling');
Route::post('/admin/sendinvoice', [App\Http\Controllers\AdminController::class, 'sendinvoice'])->name('sendinvoice');

//customer//
    //profile//
Route::get('/userprofile', [App\Http\Controllers\UserController::class, 'viewprofile'])->name('viewprofile'); 
Route::post('/userprofile/save', [App\Http\Controllers\UserController::class, 'saveprofile'])->name('saveprofile'); 
    //katalog//
Route::get('/katalog/detail/{id}', [App\Http\Controllers\UserController::class, 'viewdetailkatalog'])->name('viewdetailkatalog');
    //sampling//
Route::get('/sampling', [App\Http\Controllers\UserController::class, 'viewsampling'])->name('viewsampling');
Route::post('/sampling/save', [App\Http\Controllers\UserController::class, 'savesampling'])->name('savesampling');
Route::get('/sampling/input/{id}', [App\Http\Controllers\UserController::class, 'viewinputsampling'])->name('viewinputsampling');
Route::post('/sampling/input/save', [App\Http\Controllers\UserController::class, 'saveinputsamp'])->name('saveinputsamp');
Route::get('/editsampling/{id}', [App\Http\Controllers\UserController::class, 'vieweditsampling'])->name('vieweditsampling');
Route::post('/editsampling/saveedit', [App\Http\Controllers\UserController::class, 'saveeditS'])->name('saveeditS');
Route::post('/sampling/edit/save', [App\Http\Controllers\UserController::class, 'saveeditsampkat'])->name('saveeditsampkat');
Route::get('/reviewsampling/{id}', [App\Http\Controllers\UserController::class, 'revisisampling'])->name('revisisampling');
Route::post('/reviewsampling/saveedit', [App\Http\Controllers\UserController::class, 'saverevisiS'])->name('saverevisiS');
Route::post('/editsampling/uploadimg', [App\Http\Controllers\UserController::class, 'uploadimg'])->name('uploadimg');
Route::post('/editsampling/delimg', [App\Http\Controllers\UserController::class, 'delimg'])->name('delimg');
Route::get('/sampling/del/{id}', [App\Http\Controllers\UserController::class, 'delS'])->name('delS');
    //produksi//
Route::get('/produksi', [App\Http\Controllers\UserController::class, 'viewproduksi'])->name('viewproduksi');
Route::get('/produksi/input/{id}', [App\Http\Controllers\UserController::class, 'viewinputproduksi'])->name('viewinputproduksi');
Route::get('/produksi/edit/{id}', [App\Http\Controllers\UserController::class, 'vieweditproduksi'])->name('editproduksi');
Route::get('/produksi/edit/detail/{id}', [App\Http\Controllers\UserController::class, 'vieweditdetailprod'])->name('vieweditdetailprod');
Route::post('/produksi/edit/detail/save', [App\Http\Controllers\UserController::class, 'saveeditdetailprod'])->name('saveeditdetailprod');
Route::post('/produksi/input/save', [App\Http\Controllers\UserController::class, 'saveinputprod'])->name('saveinputprod');
Route::post('/produksi/edit/save', [App\Http\Controllers\UserController::class, 'saveeditprod'])->name('saveeditprod');
Route::get('/produksi/custom/samp', [App\Http\Controllers\UserController::class, 'viewcussampproduksi'])->name('viewcussampproduksi');
Route::post('/produksi/custom/samp/save', [App\Http\Controllers\UserController::class, 'saveprodcustom'])->name('saveprodcustom');
Route::post('/produksi/del', [App\Http\Controllers\UserController::class, 'delprod'])->name('delprod');
    //konsul//
Route::get('/konsul', [App\Http\Controllers\UserController::class, 'viewkonsul'])->name('viewkonsul');
Route::get('/konsul/input/{id}', [App\Http\Controllers\UserController::class, 'viewpilihkonsul'])->name('viewpilihkonsul');
Route::post('/konsul/input/save', [App\Http\Controllers\UserController::class, 'pilihkonsul'])->name('pilihkonsul');   
    //invoice//
Route::post('/listbayar/bukti', [App\Http\Controllers\UserController::class, 'inputbuktibyr'])->name('inputbuktibyr');   
Route::get('/listbayar', [App\Http\Controllers\UserController::class, 'viewlistbayar'])->name('viewlistbayar');
// Route::group(['middleware' => ['auth:admin']], function () {
//     Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });

