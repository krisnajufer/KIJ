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
        Schema::create('transaksi_penjualan', function (Blueprint $table) {
            $table->string('transaksi_penjualan_id', 17);
            $table->primary('transaksi_penjualan_id');
            $table->string('slug');
            $table->string('counter_id', 10);
            $table->date('tanggal_penjualan');
            $table->integer('grand_total_penjualan');

            $table->foreign('counter_id')
                ->references('counter_id')
                ->on('counter')->onDelete('cascade');

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
        Schema::dropIfExists('transaksi_penjualan');
    }
};
