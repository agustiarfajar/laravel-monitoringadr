<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanHoDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_ho_detail', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur');
            $table->string('user');
            $table->string('supplier');
            $table->unsignedBigInteger('id_barang');
            $table->string('item');
            $table->string('unit');
            $table->integer('jumlah');
            $table->string('nomor_po');
            $table->string('tgl_kedatangan');    
            
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengiriman_ho_detail');
    }
}
