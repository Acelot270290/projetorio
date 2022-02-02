<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('categoria_id'); // Chave estrangeira para categoria
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->unsignedBigInteger('acervo_id'); // Chave estrangeira para seculo
            $table->foreign('acervo_id')->references('id')->on('acervos');

            $table->string('titulo_objeto'); // Nome do objeto

            $table->string('foto_frontal_objeto', 250)->nullable();// Foto principal (Destaque)
            $table->string('foto_lateral_1_objeto', 250)->nullable();
            $table->string('foto_lateral_2_objeto', 250)->nullable();
            $table->string('foto_posterior_objeto', 250)->nullable();

            $table->unsignedBigInteger('tesauro_id'); // Chave estrangeira para tesauro
            $table->foreign('tesauro_id')->references('id')->on('tesauros');

            //Dimensões (em centímetros sempre)
            $table->decimal('altura_objeto');
            $table->decimal('largura_objeto');
            $table->decimal('profundidade_objeto');
            $table->decimal('comprimento_objeto');
            $table->decimal('diametro_objeto');

            // Material (até 3)
            $table->unsignedBigInteger('material_id_1'); // Chave estrangeira para material 1
            $table->unsignedBigInteger('material_id_2'); // Chave estrangeira para material 2
            $table->unsignedBigInteger('material_id_3'); // Chave estrangeira para material 3
            $table->foreign('material_id_1')->references('id')->on('materiais');
            $table->foreign('material_id_2')->references('id')->on('materiais');
            $table->foreign('material_id_3')->references('id')->on('materiais');

            // Tecnica (até 3)
            $table->unsignedBigInteger('tecnica_id_1'); // Chave estrangeira para Tecnica 1
            $table->unsignedBigInteger('tecnica_id_2'); // Chave estrangeira para Tecnica 2
            $table->unsignedBigInteger('tecnica_id_3'); // Chave estrangeira para Tecnica 3
            $table->foreign('tecnica_id_1')->references('id')->on('tecnicas');
            $table->foreign('tecnica_id_2')->references('id')->on('tecnicas');
            $table->foreign('tecnica_id_3')->references('id')->on('tecnicas');

            // Século
            $table->unsignedBigInteger('seculo_id'); // Chave estrangeira para seculo
            $table->foreign('seculo_id')->references('id')->on('seculos');

            $table->integer('ano_objeto');
            $table->string('autoria_objeto', 250);

            // Tombamento
            $table->unsignedBigInteger('tombamento_id'); // Chave estrangeira para seculo
            $table->foreign('tombamento_id')->references('id')->on('tombamentos');

             //Estado de conservação da Obra
            $table->unsignedBigInteger('estado_conservacao_obras_id'); // Chave estrangeira para
            $table->foreign('estado_conservacao_obras_id')->references('id')->on('estado_conservacao_obras');

            //Esécificação de Obras
            // Esse abaixo é 1:1
            $table->unsignedBigInteger('especificacao_obras_id'); // Chave estrangeira para 
            $table->foreign('especificacao_obras_id')->references('id')->on('especificacao_obras');

            // Esse abaixo é 1:1

            $table->unsignedBigInteger('condicoes_de_seguranca_obras_id'); // Chave estrangeira para 
            $table->foreign('condicoes_de_seguranca_obras_id')->references('id')->on('condicao_seguranca_obras');
            

            // Esse abaixo é 1:1
            $table->unsignedBigInteger('especificacao_seguranca_obras_id'); // Chave estrangeira para 
            $table->foreign('especificacao_seguranca_obras_id')->references('id')->on('especificacao_seguranca_obras');

                        
            // Características estilísticas/iconográficas e ornamentais
            $table->string('caracteristicas_est_icono_orna_obra', 2000);

            $table->string('observacoes_obra', 2000);

            $table->unsignedBigInteger('usuario_insercao_id');
            $table->foreign('usuario_insercao_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_atualizacao_id')->nullable();
            $table->foreign('usuario_atualizacao_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras');
    }
}
