<?php

use Illuminate\Http\Request;

Route::namespace('Auth')->group(function () {
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController')->name('login');;
    Route::post('logout', 'LogoutController');
});

// CRUD Artikela
Route::prefix('artikel')->group(function () {
    Route::post('', 'ArtikelController@createArtikel');
    Route::get('', 'ArtikelController@readAllArtikel');
    Route::get('{id}', 'ArtikelController@readDetailArtikel');
    Route::put('{id}', 'ArtikelController@updateArtikel');
    Route::delete('{id}', 'ArtikelController@deleteArtikel');
});

// CRUD Kategori
Route::prefix('kategori')->group(function () {
    Route::post('', 'KategoriController@createKategori');
    Route::get('', 'KategoriController@readKategori');
    Route::post('/{kode}', 'KategoriController@updateKategori');
    Route::delete('/{kode}', 'KategoriController@deleteKategori');
});

Route::get('user', 'UserController');
