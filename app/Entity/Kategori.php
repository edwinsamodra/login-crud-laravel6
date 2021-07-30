<?php

namespace App\Entity;

use App\Entity\Artikel;
use App\Entity\ArtikelKategori;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'kode_kategori';
    protected $keyType = 'char';
    protected $fillable = ['kode_kategori', 'nama_kategori'];
    public $timestamps = false;

    public function artikel()
    {
        return $this
        ->belongsToMany(Kategori::class, 'artikel_kategori', 'kode_kategori', 'id_artikel')
        ->using(ArtikelKategori::class);
    }
}
