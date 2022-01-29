<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcervosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acervos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_acervo');
            $table->string('cep_acervo', 9);
            $table->string('endereco_acervo', 250);
            $table->string('numero_endereco_acervo', 50);
            $table->string('bairro_acervo', 50);
            $table->string('cidade_acervo', 50);
            $table->string('UF_acervo', 2);
            $table->string('descricao_fachada_planta_acervo', 250);
            $table->string('foto_frontal_acervo', 250)->nullable();// Foto principal (Destaque)
            $table->string('foto_lateral_1_acervo', 250)->nullable();
            $table->string('foto_lateral_2_acervo', 250)->nullable();
            $table->string('foto_posterior_acervo', 250)->nullable();
            $table->string('foto_cobertura_acervo', 250)->nullable();
            $table->string('plantas_situacao_acervo', 250)->nullable();
            //$table->set('estado_conservacao_acervo', ["Excelente", "Bom", "Regular", "Péssimo"]);

            // Estado de conservação
            $table->unsignedBigInteger('estado_conservacao_acervo_id'); // Chave estrangeira para estado de conservação do acervo
            $table->foreign('estado_conservacao_acervo_id')->references('id')->on('estado_conservacao_acervos');

            $table->unsignedSmallInteger('ano_construcao_acervo');

            // Tombamento
            $table->unsignedBigInteger('tombamento_id'); // Chave estrangeira para tombamento
            $table->foreign('tombamento_id')->references('id')->on('tombamentos');

            // Século
            $table->unsignedBigInteger('seculo_id'); // Chave estrangeira para século
            $table->foreign('seculo_id')->references('id')->on('seculos');

            // Esse abaixo é 1:N
            #$table->set('especificacao_acervo', ["Sujidades", "Demolições", "Rachaduras", "Desgastes e marcas de intempéries", "Substituição de partes", "Acréscimos", "Perda de material", "Perfurações", "Pragas", "Repintura", "Respingos", "Descaracterizações", "Outros"]);
            // Especificações
            $table->unsignedBigInteger('especificacao_acervo_id'); // Chave estrangeira para estado de conservação do acervo
            $table->foreign('especificacao_acervo_id')->references('id')->on('especificacao_acervos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acervos');
    }
}
