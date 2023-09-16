<?php

use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\AcaraAdminController;
use App\Http\Controllers\RestoAdminController;
use App\Http\Controllers\BudayaAdminController;
use App\Http\Controllers\WisataAdminController;
use App\Http\Controllers\PromosiAdminController;
use App\Http\Controllers\PenginapanAdminController;

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

//Dashboard Pengguna
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/wisata', [HomeController::class, 'wisata'])->name('wisata');
// Route untuk pencarian data Wisata
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/detailwisata/{id}', [HomeController::class, 'detailwisata'])->name('detailwisata');
Route::get('/rutewisata/{id}', [HomeController::class, 'rutewisata'])->name('rutewisata');
// Route::post('/carirute', [HomeController::class, 'carirute'])->name('carirute');

Route::get('/penginapan', [HomeController::class, 'penginapan'])->name('penginapan');
Route::get('/detailpenginapan/{id}', [HomeController::class, 'detailpenginapan'])->name('detailpenginapan');
Route::get('/rutepenginapan/{id}', [HomeController::class, 'rutepenginapan'])->name('rutepenginapan');

Route::get('/resto', [HomeController::class, 'resto'])->name('resto');
Route::get('/detailresto/{id}', [HomeController::class, 'detailresto'])->name('detailresto');
Route::get('/ruteresto/{id}', [HomeController::class, 'ruteresto'])->name('ruteresto');

Route::get('/event', [HomeController::class, 'event'])->name('event');
Route::get('/detailevent/{id}', [HomeController::class, 'detailevent'])->name('detailevent');
Route::get('/ruteevent/{id}', [HomeController::class, 'ruteevent'])->name('ruteevent');

Route::get('/promosi', [HomeController::class, 'promosi'])->name('promosi');
Route::get('/detailpromosi/{id}', [HomeController::class, 'detailpromosi'])->name('detailpromosi');
Route::get('/rutepromosi/{id}', [HomeController::class, 'rutepromosi'])->name('rutepromosi');

Route::get('/lihatrute/{type}/{id}', [HomeController::class, 'lihatrute'])->name('lihatrute');


// Dashboard Admin
Route::middleware(['auth', 'auth.session', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ["title" => "Dashboard Admin"]);
    });
});

// Profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfilController::class, 'index']);
    Route::put('/edit_profil', [ProfilController::class, 'edit_profil'])->name('edit_profil');
});

//Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/loginproses', 'loginproses')->name('loginproses');
    Route::get('/logout', 'logout')->name('logout');

    // Register
    Route::get('/register', 'register')->name('register');
    Route::post('/registeruser', 'registeruser')->name('registeruser');
    Route::post('/registeradmin', 'registeradmin')->name('registeradmin');

    Route::get('/verify-email/{user}/{hash}', 'verifyEmail')->name('verification.verify');
    // Route::get('/verifyy-email/{user}/{hash}', 'verifyyEmail')->name('verificationn.verify');

    Route::get('/verification-notice', 'verificationNotice')->name('verification.notice');
    Route::get('/verification-noticee', 'verificationNoticee')->name('verification.noticee');
    Route::get('/verification-notice-first', 'verificationNoticeFirst')->name('verification.notice.first');
    Route::get('/verification-notice-second', 'verificationNoticeSecond')->name('verification.notice.second');
    Route::get('/verification-notice-secondd', 'verificationNoticeSecondd')->name('verification.notice.secondd');
    Route::get('/verification-notice-third', 'verificationNoticeThird')->name('verification.notice.third');
});

// Route::post('/send-verification-email/{user}', ['UserController@kirimEmailVerifikasi'])->name('verification.send');
Route::post('/send-verification-email/{user}', [UserController::class, 'sendverificationemail'])->name('send-verification-email');
Route::post('/send-verification-emaill/{user}', [UserController::class, 'sendverificationemaill'])->name('send-verification-emaill');

//Role Admin
Route::middleware(['auth', 'verified', 'hakakses:Admin,Wisata,Penginapan,Resto,Umum'])->group(function () {
    //Wisata
    Route::controller(WisataAdminController::class)->group(function () {
        Route::get('/wisataadmin', 'index');
        Route::get('/tambahwisataadmin', 'tambahwisataadmin');
        Route::post('/aksi_tambah_wisata', 'aksi_tambah_wisata');
        Route::get('/editwisataadmin/{id}', 'editwisataadmin');
        Route::post('/aksi_edit_wisata/{id}', 'aksi_edit_wisata');
        Route::get('/hapus/{id}', 'hapus');

        //Eksport PDF
        Route::get('/eksportpdf', 'eksportpdf');
        //Eksport Excel
        Route::get('/eksportexcel', 'eksportexcel');

        Route::get('/wisata/map', [WisataController::class, 'map'])->name('wisata.map');

        Route::get('/cancel', 'tambahwisataadmin');
    });

    //Penginapan
    Route::controller(PenginapanAdminController::class)->group(function () {
        Route::get('/penginapanadmin', 'index');
        Route::get('/tambahpenginapanadmin', 'tambahpenginapanadmin');
        Route::post('/aksi_tambah_penginapan', 'aksi_tambah_penginapan');
        Route::get('/editpenginapanadmin/{id}', 'editpenginapanadmin');
        Route::post('/aksi_edit_penginapan/{id}', 'aksi_edit_penginapan');
        Route::get('/hapusss/{id}', 'hapus');

        //Eksport PDF
        Route::get('/ekspoortpdf', 'ekspoortpdf');
        //Eksport Excel
        Route::get('/eksportexcell', 'eksportexcell');

        Route::get('/batall', 'tambahpenginapanadmin');
    });

    //Resto & Cafe
    Route::controller(RestoAdminController::class)->group(function () {
        Route::get('/restoadmin', 'index');
        Route::get('/tambahrestoadmin', 'tambahrestoadmin');
        Route::post('/aksi_tambah_resto', 'aksi_tambah_resto');
        Route::get('/editrestoadmin/{id}', 'editrestoadmin');
        Route::post('/aksi_edit_resto/{id}', 'aksi_edit_resto');
        Route::get('/hapuss/{id}', 'hapus');

        //Eksport PDF
        Route::get('/ekspooortpdf', 'ekspooortpdf');
        //Eksport Excel
        Route::get('/eeksportexceel', 'eeksportexceel');
        Route::get('/bataal', 'tambahrestoadmin');
    });

    //Budaya
    Route::controller(BudayaAdminController::class)->group(function () {
        Route::get('/budayaadmin', 'index');
        Route::get('/tambahbudayaadmin', 'tambahbudayaadmin');
        Route::post('/aksi_tambah_budaya', 'aksi_tambah_budaya');
        Route::get('/editbudayaadmin/{id}', 'editbudayaadmin');
        Route::post('/aksi_edit_budaya/{id}', 'aksi_edit_budaya');
        Route::get('/hapussss/{id}', 'hapus');

        Route::get('/batal', 'tambahbudayaadmin');
    });

    //Data User
    Route::controller(UserController::class)->group(function () {
        Route::get('/useradmin', 'index');
        Route::get('/tambahuser', 'tambahuser');
        Route::post('/tambahdatauser', 'tambahdatauser');
        Route::get('/tampilkandatauser/{id}', 'tampilkandatauser');
        Route::post('/updatedatauser/{id}', 'updatedatauser');
        Route::get('/happussss/{id}', 'hapus');

        Route::get('/batal', 'tambahuser');
    });

    //Data Acara
    Route::middleware(['auth', 'auth.session', 'verified'])->group(function () {
        Route::controller(AcaraAdminController::class)->group(function () {
            Route::get('/acaraadmin', 'index');
            Route::get('/tambahacaraadmin', 'tambahacaraadmin');
            Route::post('/aksi_tambah_acara', 'aksi_tambah_acara');
            Route::get('/editacaraadmin/{id}', 'editacaraadmin');
            Route::post('/aksi_edit_acara/{id}', 'aksi_edit_acara');
            Route::get('/hhappuss/{id}', 'hapus');

            //Eksport PDF
            Route::get('/ekksportpdf', 'ekksportpdf');
            //Eksport Excel
            Route::get('/ekssportexcel', 'ekssportexcel');
            Route::get('/baatal', 'tambahacaraadmin');
        });
    });

    //Data Promosi
    Route::middleware(['auth', 'auth.session', 'verified'])->group(function () {
        Route::controller(PromosiAdminController::class)->group(function () {
            Route::get('/promosiadmin', 'index');
            Route::get('/tambahpromosiadmin', 'tambahpromosiadmin');
            Route::post('/aksi_tambah_promosi', 'aksi_tambah_promosi');
            Route::get('/editpromosiadmin/{id}', 'editpromosiadmin');
            Route::post('/aksi_edit_promosi/{id}', 'aksi_edit_promosi');
            Route::get('/hhapuss/{id}', 'hapus');

            //Eksport PDF
            Route::get('/eeksportpdf', 'eeksportpdf');
            //Eksport Excel
            Route::get('/ekksportexcel', 'ekksportexcel');

            Route::get('/bbaatal', 'tambahpromosiadmin');
        });
    });

    //Forum
    Route::controller(ForumController::class)->group(function () {
        Route::get('/forum', 'forum')->name('forum');
        Route::post('/aksi_tambah_forum', 'aksi_tambah_forum')->name('aksi_tambah_forum');
        Route::get('/forum/{forum}/view', 'view')->name('view');
        Route::post('/forum/{forum}/view', 'post_komentar')->name('post_komentar');
        Route::post('/forum/like', 'like')->name('forum.like');
        Route::get('/forum/{forum}/edit', 'edit_forum')->name('edit_forum');
        Route::post('/forum/{forum}', 'aksi_edit_forum')->name('aksi_edit_forum');
        Route::get('/forum/{id}', 'hapus_forum');
        // Tambahkan route untuk edit komentar
        Route::get('/forum/{komentar}/edit', 'ForumController@edit_komentar')->name('edit_komentar');
        Route::post('/forum/{komentar}/edit', 'ForumController@aksi_edit_komentar')->name('aksi_edit_komentar');

        // Tambahkan route untuk hapus komentar
        Route::get('/forum/{komentar}/hapus', 'ForumController@hapus_komentar')->name('hapus_komentar');
    });
});
