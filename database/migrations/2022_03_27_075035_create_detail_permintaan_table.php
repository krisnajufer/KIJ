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
        Schema::create('detail_permintaan', function (Blueprint $table) {
            $table->id();
            $table->string('permintaan_id', 17);
            $table->string('barang_id', 10);
            $table->integer('jumlah_permintaan');
            $table->timestamps();

            $table->foreign('permintaan_id')
                ->references('permintaan_id')
                ->on('permintaan')->onDelete('cascade');

            $table->foreign('barang_id')
                ->references('barang_id')
                ->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_permintaan');
    }
};
