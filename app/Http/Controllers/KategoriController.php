<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Kategori;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function readKategori(Request $req)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'successfully read all categories',
            'data' => Kategori::all()
        ], 200);
    }

    public function createKategori(Request $req)
    {
        Kategori::create($req->all());

        return response()->json([
            'status' => 'success',
            'message' => 'successfully created new category',
            'data' => $req->all()
        ], 200);
    }

    public function updateKategori(Request $req, $kode)
    {
        $kategori = Kategori::find($kode)->update($req->all());

        return response()->json([
            'status' => 'success',
            'message' => 'successfully updated category',
            'data' => $req->all()
        ], 200);
    }

    public function deleteKategori($kode)
    {
        $kategori = Kategori::find($kode)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'successfully deleted category',
            'data' => null
        ], 200);
    }
}
