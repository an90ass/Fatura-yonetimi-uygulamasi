<?php

use Illuminate\Support\Facades\Auth;
use App\faturalars;
use App\Models\faturalar;
use App\Models\urunler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaturaAttachmentsController;
use App\Http\Controllers\Musteriler_RaporlariController;

use App\Http\Controllers\FaturalarsController;
//use App\Http\Controllers\AttachmentsController;
// use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\FaturalarDetailsController;
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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
//Auth::routes(['register'=> false]); // to close users register
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Route::resource('faturalar', 'FaturalarController');//faturalar listesi sunmak icin


Route::resource('faturalars', 'App\Http\Controllers\FaturalarsController');
Route::resource('bolumler', 'App\Http\Controllers\BolumlerController');
Route::resource('urunler', 'App\Http\Controllers\UrunlerController');
Route::resource('FaturaAttachments', 'App\Http\Controllers\FaturaAttachmentsController');
Route::resource('Arsiv', 'App\Http\Controllers\FaturalarArsiviController');




//Route::get('/bolum/{id}', [App\Http\Controllers\HomeController::class, 'geturunler'])->name('bolum');
//Route::get('bolum/{id}', 'FaturalarsController@geturunler');
Route::get('bolum/{id}', [FaturalarsController::class, 'geturunler']);

//Route::get('bolum/{id}', [App\Http\Controllers\FaturalarController::class ,'geturunler']);
//Route::get('bolum/{id}', 'App\Http\Controllers\FaturalarsController@geturunler');
// Route::get('bolum/{id}', [FaturalarsController::class,'@geturunler']);
//33 Route::get('/bolum/{id}', 'FaturalarsController @geturunler');
//Route::get('/bolum/{id}', [FaturalarsController::class,'geturunler']);







Route::get('/FaturalarDetails/{id}', 'App\Http\Controllers\FaturalarDetailsController@edit');
Route::get('View_file/{fatura_numarasi}/{file_name}', 'App\Http\Controllers\FaturalarDetailsController@open_file');
Route::get('download/{fatura_numarasi}/{file_name}', 'App\Http\Controllers\FaturalarDetailsController@get_file');
Route::post('delete_file', 'App\Http\Controllers\FaturalarDetailsController@destory')->name('delete_file');
Route::get('/edit_fatura/{id}', 'App\Http\Controllers\FaturalarsController@edit');
Route::get('/Durumu_goster/{id}', 'App\Http\Controllers\FaturalarsController@show')->name('Durumu_goster');
Route::post('/Durum_Update/{id}', 'App\Http\Controllers\FaturalarsController@Durum_Update')->name('Durum_Update');

Route::get('Odenmis_Faturalar','App\Http\Controllers\FaturalarsController@Odenmis_Faturalar');
Route::get('Odenmemis_Faturalar','App\Http\Controllers\FaturalarsController@Odenmemis_Faturalar');
Route::get('Kismenodenmis_Faturalar','App\Http\Controllers\FaturalarsController@Kismenodenmis_Faturalar');
Route::get('/print_fatura/{id}', 'App\Http\Controllers\FaturalarsController@print_fatura');

Route::get('faturalar_raporlari', 'App\Http\Controllers\Faturalar_RaporlariController@index');
Route::post('Search_faturalar', 'App\Http\Controllers\Faturalar_RaporlariController@Search_faturalar');
Route::get('musteriler_raporlari', 'App\Http\Controllers\Musteriler_RaporlariController@index');
Route::post('Search_musteriler', 'App\Http\Controllers\Musteriler_RaporlariController@Search_musteriler');

Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
