<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_reserva', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_reserva')->unsigned();
            $table->foreign('id_reserva')->references('id')->on('reserva')->onDelete('cascade');
            $table->bigInteger('id_servicio')->unsigned();
            $table->foreign('id_servicio')->references('id')->on('servicio');;
            $table->integer('cantidad');
            $table->decimal('precio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_reserva');
    }
}
