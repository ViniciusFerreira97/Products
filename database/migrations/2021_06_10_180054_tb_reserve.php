<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbReserve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_reserve', function (Blueprint $table) {
            $table->increments('id_reserve');
            $table->integer('id_product')->unsigned();
            $table->integer('quantity_reserve');
            $table->foreign('id_product')->references('id_product')->on('tb_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_reserve');
    }
}
