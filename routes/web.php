<?php

use App\Http\Controllers\AdminDokumenController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DocumentParentController;
use App\Http\Controllers\InfographicController;
use App\Http\Controllers\InovasiController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LiputanController;
use App\Http\Controllers\VideoController;
use App\Models\Artikel;
use App\Models\Infographic;
use App\Models\Inovasi;
use App\Models\Liputan;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DocumentParentController::class)->group(function () {
  Route::get('/dokumen', 'index')->name('dokumen.index');
  Route::get('/dokumen/{parent}', 'parent')->name('dokumen.parent');
});

Route::controller(LandingPageController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::get('edukasi', 'edukasi')->name('edukasi');
  Route::get('infografis', 'infografis')->name('infografis');
  Route::get('video', 'video')->name('video');
  Route::get('data-stunting', 'datastunting')->name('data-stunting');
  Route::get('data-stunting/liputan', 'liputan')->name('data-stunting.liputan');
  Route::get('data-stunting/program-pemerintah', 'inovasi')->name('data-stunting.inovasi');
  Route::get('data-stunting/program-pemerintah/download/{id}', 'download')->name('data-stunting.inovasi.download');
});


// Administrator
Route::middleware(['auth'])->prefix('admin')->group(function () {

  Route::controller(AdminDokumenController::class)->prefix('dokumen')->group(function () {
    Route::get('parent-dokumen/index', 'indexDocumentParent')->name('admin.parentdocument.index');
    Route::post('parent-dokumen/create', 'createDocumentParent')->name('admin.parentdocument.create');
    Route::get('parent-dokumen/edit/{id}', 'editDocumentParent')->name('admin.parentdocument.edit');
    Route::patch('parent-dokumen/update/{id}', 'updateDocumentParent')->name('admin.parentdocument.update');
    Route::delete('parent-dokumen/destroy/{id}', 'destroyDocumentParent')->name('admin.parentdocument.destroy');
    Route::post('parent-dokumen/search', 'searchDocumentParent')->name('admin.parentdocument.search');
  });

  Route::controller(AdminDokumenController::class)->prefix('dokumen')->group(function () {
    Route::get('index', 'indexDocument')->name('admin.document.index');
    Route::post('create', 'createDocument')->name('admin.document.create');
    Route::get('edit/{id}', 'editDocument')->name('admin.document.edit');
    Route::patch('update/{id}', 'updateDocument')->name('admin.document.update');
    Route::delete('destroy/{id}', 'destroyDocument')->name('admin.document.destroy');
    Route::post('search', 'searchDocument')->name('admin.document.search');
    Route::get('download/{id}', 'downloadDocument')->name('admin.document.download');
  });

  Route::get('beranda', function () {
    return view('admin.beranda');
  })->name('beranda');
  // Artikel
  Route::controller(ArtikelController::class)->prefix('artikel')->group(function () {
    Route::get('', 'index')->name('artikel.index');
    Route::post('create', 'create')->name('artikel.create');
    Route::get('{id}', 'edit')->name('artikel.edit');
    Route::patch('{id}', 'update')->name('artikel.update');
    Route::delete('{id}', 'destroy')->name('artikel.destroy');
    Route::post('search', 'search')->name('artikel.search');
  });

  // Infografis
  Route::controller(InfographicController::class)->prefix('infografis')->group(function () {
    Route::get('', 'index')->name('infographic.index');
    Route::post('create', 'create')->name('infographic.create');
    Route::get('{id}', 'edit')->name('infographic.edit');
    Route::patch('{id}', 'update')->name('infographic.update');
    Route::delete('{id}', 'destroy')->name('infographic.destroy');
    Route::post('search', 'search')->name('infographic.search');
  });

  // Video
  Route::controller(VideoController::class)->prefix('video')->group(function () {
    Route::get('', 'index')->name('video.index');
    Route::post('create', 'create')->name('video.create');
    Route::get('{id}', 'edit')->name('video.edit');
    Route::patch('{id}', 'update')->name('video.update');
    Route::delete('{id}', 'destroy')->name('video.destroy');
    Route::post('search', 'search')->name('video.search');
  });

  // Liputan
  Route::controller(LiputanController::class)->prefix('liputan')->group(function () {
    Route::get('', 'index')->name('liputan.index');
    Route::post('create', 'create')->name('liputan.create');
    Route::get('{id}', 'edit')->name('liputan.edit');
    Route::patch('{id}', 'update')->name('liputan.update');
    Route::delete('{id}', 'destroy')->name('liputan.destroy');
    Route::post('search', 'search')->name('liputan.search');
  });

  // inovasi
  Route::controller(InovasiController::class)->prefix('inovasi')->group(function () {
    Route::get('', 'index')->name('inovasi.index');
    Route::post('create', 'create')->name('inovasi.create');
    Route::get('{id}', 'edit')->name('inovasi.edit');
    Route::patch('{id}', 'update')->name('inovasi.update');
    Route::delete('{id}', 'destroy')->name('inovasi.destroy');
    Route::post('search', 'search')->name('inovasi.search');
    Route::get('download/{id}', 'download')->name('inovasi.download');
  });
});
