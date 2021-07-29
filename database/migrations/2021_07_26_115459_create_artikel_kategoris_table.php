<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Artikel Kategori
        Schema::create('artikel_kategori', function (Blueprint $table) {
            $table->integer('id', 11);
            $table->integer('id_artikel', 11);
            $table->char('kode_kategori', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artikel_kategori');
    }
}
