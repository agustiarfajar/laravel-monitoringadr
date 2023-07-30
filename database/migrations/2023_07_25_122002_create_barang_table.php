<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('user');    
            $table->unsignedBigInteger('id_perusahaan');
            $table->string('pemasok');
            $table->string('item');
            $table->integer('jumlah');
            $table->string('unit');
            $table->string('nomor_po');
            $table->date('tgl_kedatangan');

            $table->foreign('id_perusahaan')->references('id')->on('ms_perusahaan')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
