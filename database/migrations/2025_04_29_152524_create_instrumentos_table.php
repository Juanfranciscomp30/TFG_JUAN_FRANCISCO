<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumentos', function (Blueprint $table) {
            $table->id();  // Crea un id auto_increment
            $table->string('tipo');  // Tipo de instrumento (ej. guitarra, piano, etc.)
            $table->string('descripcion')->nullable();  // Descripción del instrumento (opcional)
            $table->string('marca');  // Marca del instrumento
            $table->string('modelo');  // Modelo del instrumento
            $table->decimal('precio', 10, 2);  // Precio con dos decimales
            $table->string('foto')->nullable();  // Foto del instrumento (opcional)
            $table->timestamps();  // Crea los campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instrumentos');
    }
}
