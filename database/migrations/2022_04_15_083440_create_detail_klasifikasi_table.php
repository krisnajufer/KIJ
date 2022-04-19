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
        Schema::create('detail_klasifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('klasifikasi_id', 10);
            $table->string('barang_id', 10);
            $table->integer('permintaan_tahunan');
            $table->float('persentase_biaya', 5, 2);
            $table->string('klasifikasi', 10);

            $table->foreign('klasifikasi_id')
                ->references('klasifikasi_id')
                ->on('klasifikasi')->onDelete('cascade');

            $table->foreign('barang_id')
                ->references('barang_id')
                ->on('barang')->onDelete('cascade');

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
        Schema::dropIfExists('detail_klasifikasi');
    }
};
