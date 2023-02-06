<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\SiteContato;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       /*  $contato = new SiteContato();
        $contato->nome = 'Sistema SG';
        $contato->telefone = '(34) 99271-8265';
        $contato->email = 'contato@sitecontato.com.br';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Seja bem vindo ao sistem Super Gestão!';
        $contato->save(); */

        \App\Models\SiteContato::factory()->count(100)->create();
    }
}
