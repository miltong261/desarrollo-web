<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoHabitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_habitacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_promocion')->unsigned();
            $table->string('nombre',50);
            $table->string('descripcion',250)->nullable();
            $table->integer('capacidad');
            $table->decimal('tarifa');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('id_promocion')->references('id')->on('promocion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('tipo_habitacion');
    }
}
