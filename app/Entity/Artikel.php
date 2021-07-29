<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';
    protected $fillable = ['judul', 'headline', 'isi', ];

    public function a()
    {
        return $this->hasMany(Artikel_kategori::class, 'id_artikel', 'id_artikel');
    }
}
