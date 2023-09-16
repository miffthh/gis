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
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata');
            $table->text('kategori');
            $table->text('deskripsi_singkat');
            $table->string('harga_tiket');
            $table->string('akses_kendaraan');
            $table->string('jam_operasional');
            $table->string('website');
            $table->string('kontak');
            $table->string('fasilitas');
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
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
        Schema::dropIfExists('wisata');
    }
};
