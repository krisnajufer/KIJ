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
        Schema::create('barang_counter', function (Blueprint $table) {
            $table->string('barang_counter_id', 10);
            $table->primary('barang_counter_id');
            $table->string('slug');
            $table->string('barang_id', 10);
            $table->string('counter_id', 10);
            $table->integer('barang_counter_stok');

            $table->foreign('barang_id')
                ->references('barang_id')
                ->on('barang')->onDelete('cascade');

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
        Schema::dropIfExists('barang_counter');
    }
};
