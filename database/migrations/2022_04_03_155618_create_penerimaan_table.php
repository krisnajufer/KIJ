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
        Schema::create('penerimaan', function (Blueprint $table) {
            $table->string('penerimaan_id', 17);
            $table->primary('penerimaan_id');
            $table->string('slug');
            $table->string('pengiriman_id', 17);
            $table->string('counter_id', 10);
            $table->date('tanggal_penerimaan');

            $table->foreign('pengiriman_id')
                ->references('pengiriman_id')
                ->on('pengiriman')->onDelete('cascade');

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
        Schema::dropIfExists('penerimaan');
    }
};
