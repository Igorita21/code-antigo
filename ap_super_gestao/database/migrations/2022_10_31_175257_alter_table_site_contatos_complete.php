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
   

        Schema::table('site_contatos', function (Blueprint $table){
            $table->string('telefone', 50)->after('nome')->nullable();
            $table->string('email', 50)->after('telefone')->nullable();
            $table->integer('motivo_contato')->after('email')->nullable();
            $table->text('mensagem')->after('motivo_contato')->nullable();
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
        Schema::table('site_contatos', function (Blueprint $table){
            $table->dropColumn('telefone');
            $table->dropColumn('email');
            $table->dropColumn('motivo_contato');
            $table->dropColumn('mensagem');
        });

    }
};
