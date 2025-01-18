<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tmp_compras', function (Blueprint $table) {
            $table->id();

            $table->integer('cantidad');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');

            /*Esto me va a permitir realizar una sesion de forma temporal.
            Registro de forma temporal, otro usuario ingresa al sistema con otra cuenta
            y se pueda diferenciar del otro usuario que SI estaba realizando el registro*/
            $table->string('session_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmp_compras');
    }
};
