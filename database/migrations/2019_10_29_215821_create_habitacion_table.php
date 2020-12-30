<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_tipo_habitacion')->unsigned();
            $table->string('no_habitacion');
            $table->string('observacion',250)->nullable();
            $table->dateTime('checkin')->nullable();
            $table->dateTime('checkout')->nullable();
            $table->string('estado')->default('Disponible');
            $table->boolean('habilitado')->default(1);
            $table->timestamps();
            $table->foreign('id_tipo_habitacion')->references('id')->on('tipo_habitacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habitacion');
    }
}
