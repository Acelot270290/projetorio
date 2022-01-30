<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('categoria_id'); // Chave estrangeira para categoria
            $table->foreign('categoria_id')->references('id')->on('categorias');

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

            // Tesauro (até 3)
            $table->unsignedBigInteger('tesauro_id_1'); // Chave estrangeira para tesauro 1
            $table->unsignedBigInteger('tesauro_id_2'); // Chave estrangeira para tesauro 2
            $table->unsignedBigInteger('tesauro_id_3'); // Chave estrangeira para tesauro 3
            $table->foreign('tesauro_id_1')->references('id')->on('tesauros');
            $table->foreign('tesauro_id_2')->references('id')->on('tesauros');
            $table->foreign('tesauro_id_3')->references('id')->on('tesauros');

            // Século
            $table->unsignedBigInteger('seculo_id'); // Chave estrangeira para seculo
            $table->foreign('seculo_id')->references('id')->on('seculos');

            $table->integer('ano_objeto');
            $table->string('autoria_objeto', 250);

            // Tombamento
            $table->unsignedBigInteger('tombamento_id'); // Chave estrangeira para seculo
            $table->foreign('tombamento_id')->references('id')->on('tombamentos');

            $table->set('estado_conservacao_objeto', ["Excelente", "Bom", "Regular", "Precisa de restauração"]);

            // Esse abaixo é 1:N
            $table->set('especificacao_objeto', ["Sujidades", "Manchas", "Perda de material", "Manchas de cupim", "Substituição de partes", "Perda de policromia", "Oxidações", "Uso de abrasivos", "Redouramento", "Rachaduras", "Craquelados", "Perfurações", "Repintura", "Respingos", "Recarnação", "Mossas", "Outros"]);

            $table->set('condicoes_de_seguranca_objeto', ["Bom", "Regular", "Ruim"]);
            // Esse abaixo é 1:N
            $table->set('especificacao_de_seguranca_objeto', ["Exposto à umidade", "Mal acondicionado", "Perigo de contato manual", "Perigo de furto/roubo", "Perigo de inundação", "Exposto à luz", "Perigo de goteira", "Abandonado", "Outros"]);

            // Características estilísticas/iconográficas e ornamentais
            $table->string('caracteristicas_est_ico_orna_objeto', 2000);

            $table->string('observacoes_objeto', 2000);

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
        Schema::dropIfExists('objetos');
    }
}
