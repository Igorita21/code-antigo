<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            //criando a tabela filiais
            Schema::create('filiais', function(Blueprint $table) {
                $table->id();   
                $table->string('filial', 30); 
                $table->timestamps();
            });

            //criando a tabela produto_filiais
            Schema::create('produto_filiais', function(Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('filial_id');
                $table->unsignedBigInteger('produto_id');
                $table->float('preco_venda', 8, 2)->default(0.01);
                $table->integer('estoque_minimo')->default(1);
                $table->integer('estoque_maximo')->default(1);
                $table->timestamps();

                //construente id filiais
                $table->foreign('filial_id')->references('id')->on('filiais');

                //construente id produtos
                $table->foreign('produto_id')->references('id')->on('produtos');
            });
            
            //removendo colunas da tabela produto
            Schema::table('produtos', function (Blueprint $table){
                $table->dropColumn(['preco_venda', 'estoque_minimo', 'estoque_maximo']);
            });

          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        //adicionando colunas na tabela produtos
        //removendo colunas da tabela produto_detalhes
        Schema::table('produtos', function(Blueprint $table){
            $table->float('preco_venda', 8, 2)->default(0.01);
            $table->integer('estoque_minimo')->default(1);
            $table->integer('estoque_maximo')->default(1);
        });


        Schema::dropIfExists('produto_filiais');


        Schema::dropIfExists('filiais');

    }
};
