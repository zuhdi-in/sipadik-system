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
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::enableForeignKeyConstraints();

        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_surat_id');
            $table->foreign('jenis_surat_id')->references('id')->on('jenis_surat');
        });

        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_surat_id');
            $table->foreign('jenis_surat_id')->references('id')->on('jenis_surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_surat');
    }
};
