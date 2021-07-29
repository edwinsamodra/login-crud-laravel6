<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Artikel_kategori extends Model
{
    protected $table = 'artikel_kategori';
    protected $primaryKey = 'id';
    protected $fillable = ['id_artikel', 'kode_kategori'];
    public $timestamps = false;

    public function c()
    {
        return $this->belongsToMany(Kategori::class, 'kode_kategori', 'kode_kategori');
    }
}
