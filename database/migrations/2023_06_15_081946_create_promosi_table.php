<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promosi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_promosi');
            $table->string('deskripsi_singkat');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->string('harga_awal');
            $table->string('harga_promo');
            $table->string('sk');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('promosi');
    }
};
