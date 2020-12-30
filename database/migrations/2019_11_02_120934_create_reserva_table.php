<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->bigInteger('id_habitacion')->unsigned();
            $table->foreign('id_habitacion')->references('id')->on('habitacion')->onDelete('cascade');
            $table->string('codigo')->nullable();
            $table->string('nombre',100);
            $table->string('email');
            $table->date('fecha_reserva');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('dias');
            $table->integer('adultos');
            $table->integer('ninos');
            $table->decimal('descuento');
            $table->decimal('total');
            $table->string('estado')->default('confirmada');
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
        Schema::dropIfExists('reserva');
    }
}
