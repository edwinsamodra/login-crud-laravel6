<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ArtikelKategori extends Pivot
{
    protected $table = 'artikel_kategori';
    public $incrementing = true;
}
