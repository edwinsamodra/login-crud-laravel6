<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'kode_kategori';
    protected $keyType = 'char';
    protected $fillable = ['kode_kategori', 'nama_kategori'];
    public $timestamps = false;

    public function b()
    {
        // return $this->hasMany(Artikel_kategori::class, 'kode_kategori', 'kode_kategori');
    }
}
