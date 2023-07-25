<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDataTable extends Migration
{
    public function up()
    {
        Schema::create('form_data', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan');
            $table->string('pic');
            $table->set('ekspedisi', ['...']);
            $table->string('user');
            $table->string('suplier');
            $table->string('item');
            $table->integer('jumlah');
            $table->set('unit', ['unit', 'pcs', 'set', 'box', 'sht', 'ltr', 'roll','pack']);
            $table->string('nomor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_data');
    }

    
}
