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

    public function readDetailArtikel($id)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'successfully read all articles',
            'data' => ([
                "artikel_data" => Artikel::where('id_artikel', $id)->get(),
                "kategori" =>   Artikel_kategori::select("kategori.nama_kategori")
                                ->join("kategori", function($join) {
                                    $join->on("kategori.kode_kategori", "=", "artikel_kategori.kode_kategori");
                                })
                                ->where('id_artikel', $id)->get()
            ])
        ], 200);
    }

    public function readAllArtikel()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'successfully read all articles',
            'data' => Artikel::select("id_artikel", "judul", "headline", "created_at", "updated_at")->get()
        ], 200);
    }

    public function readByCategory($kategori)
    {
        $data = Artikel::select("artikel")
        ->join("artikel_kategori", function($join) {
            $join->on("artikel_kategori.id_artikel", "=", "artikel.id_artikel");
        })
        ->join("kategori", function($join) {
            $join->on("kategori.kode_kategori", "=", "artikel_kategori.kode_kategori");
        })
        ->select("artikel_kategori.id", "artikel.judul", "artikel.headline", "artikel.created_at", "artikel.updated_at")
        ->where("kategori.kode_kategori", "=", $kategori)
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'successfully read all articles by category',
            'data' => $data
        ], 200);
    }

    public function readByTitle($judul)
    {
        $data = Artikel::select("id_artikel", "judul", "headline", "created_at", "updated_at")
        ->where("artikel.judul", "like", "%" . $judul . "%")
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'successfully read all articles by title',
            'data' => $data
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
