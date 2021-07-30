<?php

namespace App\Entity;

use App\Entity\ArtikelKategori;
use App\Entity\Kategori;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';
    protected $fillable = ['judul', 'headline', 'isi', ];

    public function kategori()
    {
        return $this
        ->belongsToMany(Kategori::class, 'artikel_kategori', 'id_artikel', 'kode_kategori')
        ->using(ArtikelKategori::class);
    }
}
