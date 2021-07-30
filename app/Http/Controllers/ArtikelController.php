<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Artikel;
use App\Entity\Artikel_kategori; // di table ini akan otomatis create, ketika artikel jg dibuat
use App\Entity\Kategori; // fungsinya untuk nampilin biar bisa milih kategori yg tepat saat write new article

// CRUD Need Login

class ArtikelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['readAllArtikel', 'readDetailArtikel', 'readByCategory', 'readByTitle']);
    }

    public function readAllArtikel(Request $req)
    {
        $artikel = new Artikel();
        
        if ($kategori = $req->query->get('kategori')) {
            $artikel = $artikel->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama_kategori', $kategori);
            });
        }

        if ($judul = $req->query->get('judul')) {
            $artikel = $this->model->where('judul', 'like', '%'.$judul.'%');
        }

        $artikel = $artikel->get();

        return response()->json([
            'status' => 'success',
            'message' => 'successfully read all articles',
            'data' => $artikel
        ], 200);
    }

    public function readDetailArtikel($id)
    {
        $artikel = Artikel::find($id);
        if (!$artikel) {
            return response()->json([
                'status' => 'failed',
                'message' => 'article data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'successfully read all articles',
            'data' => $artikel
        ], 200);
    }

    public function createArtikel(Request $req)
    {
        $artikel = new Artikel;
        $artikel->judul = $req->judul;
        $artikel->headline = $req->headline;
        $artikel->isi = $req->isi;
        $artikel->save();

        $categories = $req->categories;
        $artikel->kategori->attach($categories);

        return response()->json([
            'status' => 'success',
            'message' => 'successfully create new article',
            'data' => $artikel
        ], 200);
    }

    public function updateArtikel(Request $req, $id)
    {
        Artikel::where('id_artikel', $id)->update($req->all());

        return response()->json([
            'status' => 'success',
            'message' => 'successfully updated article',
            'data' => $req->all()
        ], 200);
    }

    public function deleteArtikel($id)
    {
        Artikel::find($id)->delete();
        Artikel_kategori::where('id_artikel', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'successfully deleted article',
            'data' => null
        ], 200);
    }
}
