<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_reserva')->unsigned();
            $table->foreign('id_reserva')->references('id')->on('reserva');
            $table->bigInteger('id_tipo_pago')->unsigned();
            $table->foreign('id_tipo_pago')->references('id')->on('tipo_pago');
            $table->dateTime('fecha_pago');
            $table->string('concepto',250)->nullable();
            $table->decimal('monto',8,2);
            $table->decimal('pendiente',8,2);
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago');
    }
}
