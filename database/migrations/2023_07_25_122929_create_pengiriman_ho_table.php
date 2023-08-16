<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanHoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_ho', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur');
            $table->unsignedBigInteger('id_perusahaan');
            $table->string('pic');
            $table->unsignedBigInteger('id_ekspedisi');
            $table->date('tgl_surat_jalan')->nullable();
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
        Schema::dropIfExists('pengiriman_ho');
    }
}