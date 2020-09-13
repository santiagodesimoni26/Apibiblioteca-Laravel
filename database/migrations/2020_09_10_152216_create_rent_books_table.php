<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idlibro')->unsigned();
            $table->integer('idusuario')->unsigned();
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion')->nullable();
            $table->timestamps();

            $table->foreign('idlibro')->references('id')->on('books');
            $table->foreign('idusuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_books');
    }
}
