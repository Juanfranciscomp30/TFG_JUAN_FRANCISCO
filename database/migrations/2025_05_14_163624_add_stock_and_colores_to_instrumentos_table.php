<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('instrumentos', function (Blueprint $table) {
            $table->integer('stock')->default(0);
            $table->text('colores')->nullable(); // por si no hay colores definidos
        });
    }
    
    public function down()
    {
        Schema::table('instrumentos', function (Blueprint $table) {
            $table->dropColumn('stock');
            $table->dropColumn('colores');
        });
    }
};
