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
        Schema::create('detail_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->string('pengiriman_id', 17);
            $table->string('barang_id', 10);
            $table->integer('jumlah_pengiriman');
            $table->string('sumber');
            $table->string('gudang_id', 10)->nullable();
            $table->string('counter_id', 10)->nullable();
            $table->string('persetujuan');
            $table->text('alasan');

            $table->foreign('pengiriman_id')
                ->references('pengiriman_id')
                ->on('pengiriman')->onDelete('cascade');

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
        Schema::dropIfExists('detail_pengiriman');
    }
};
