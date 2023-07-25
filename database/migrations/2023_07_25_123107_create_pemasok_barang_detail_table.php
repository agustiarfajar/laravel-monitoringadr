<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasokBarangDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasok_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur');
            $table->string('user');
            $table->string('supplier');
            $table->string('item');
            $table->integer('jumlah');
            $table->string('unit');
            $table->string('nomor_po');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasok_barang_detail');
    }
}
