<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seculos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo_seculo'); // O "nome" do século (Ex: XX)
            $table->string('ano_inicio_seculo'); // Primeiro ano do século (Ex: 1901)
            $table->string('ano_fim_seculo'); // Último ano do século (Ex: 2000)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seculos');
    }
}
