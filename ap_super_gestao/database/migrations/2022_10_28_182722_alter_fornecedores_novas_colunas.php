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
        //
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('uf', 2);
            $table->string('email', 150);
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
        Schema::table('fornecedores', function (Blueprint $table) {
            //para remover colunas
            // podemos utilizar esse metodo para uma coluna apenas $table->dropColumn ('uf');
            //porem podemos passar por parametro mais de uma coluna em um array
            $table->dropColumn(['uf', 'email']);
            //podemo utilizar esse metodo para excluir toda a tabela Schema::dropIfExists('fornecedores');
        });
        
    }

};
