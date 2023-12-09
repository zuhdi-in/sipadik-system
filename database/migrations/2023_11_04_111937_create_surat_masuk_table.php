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
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();            
            $table->string('nomor_surat')->nullable();
            $table->string('perihal')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('pengirim')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->string('disposisi')->nullable();
            $table->text('berkas')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuk');
    }
};
