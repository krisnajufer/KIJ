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
        Schema::create('detail_transaksi_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi_penjualan_id', 10);
            $table->string('barang_counter_id', 10);
            $table->integer('qty_penjualan');
            $table->integer('subtotal_penjualan');

            $table->foreign('transaksi_penjualan_id')
                ->references('transaksi_penjualan_id')
                ->on('transaksi_penjualan')->onDelete('cascade');

            $table->foreign('barang_counter_id')
                ->references('barang_counter_id')
                ->on('barang_counter')->onDelete('cascade');

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
        Schema::dropIfExists('detail_transaksi_penjualan');
    }
};
