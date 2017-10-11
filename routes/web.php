<?php

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
use App\Catastro;
Route::get('/', function (){ return view('inicio'); });	
Route::get('/catastro', 'VcatastroController@getData');	
Route::get('/catastro/edit/{id}', 'VcatastroController@viewmodal');
Route::post('/catastro/add', 'VcatastroController@add');
Route::post('/catastro/save', 'VcatastroController@updateView');
Route::get('/catastro/buscar','VcatastroController@search');

