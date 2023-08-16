<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDataTable extends Migration
{
    public function up()
    {
        Schema::create('ekspedisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ekspedisi');
        });

        Schema::create('form_data', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan');
            $table->string('pic');
            $table->unsignedBigInteger('ekspedisi_id'); // Foreign key to ekspedisi table
            $table->string('user');
            $table->string('suplier');
            $table->string('item');
            $table->integer('jumlah');
            $table->string('unit'); // Using VARCHAR instead of SET
            $table->string('nomor');
            $table->timestamps();

            $table->foreign('ekspedisi_id')->references('id')->on('ekspedisi')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_data');
        Schema::dropIfExists('ekspedisi');
    }
}