<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasokBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasok_barang', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur');
            $table->unsignedBigInteger('id_perusahaan');
            $table->string('pic');
            $table->unsignedBigInteger('id_ekspedisi');
            $table->string('pemasok');
            $table->string('alamat')->nullable();
            $table->string('telpon');
            $table->date('tgl_surat_jalan')->nullable();
            $table->date('tgl_kirim_pemasok')->nullable();
            $table->date('tgl_diterima_site')->nullable();     
            $table->string('status'); // Enum types not supported, using string instead
            $table->timestamps();

            $table->foreign('id_perusahaan')->references('id')->on('ms_perusahaan');
            $table->foreign('id_ekspedisi')->references('id')->on('ms_ekspedisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasok_barang');
    }
}