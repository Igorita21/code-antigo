<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SiteContato;

class ContatoController extends Controller
{
    public function contato()
    {           
        return view("site.contato");
    }

    public function salvar(Request $request)
    {

        //realizar a validacao dos dados do formulario
        
        $regras =  
        [
        'nome' => 'required|min:3|max:40',   //nomes com no minimo 3 caracteres e no maximo 40
        'telefone' => 'required',
        'email' => 'email' ,
        'motivo_contato' =>  'required',    
        'mensagem' => 'required|max:2000'
        ];

        $validacoes = [
            'nome.required' => 'É necessário preencher o campo nome!',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres!',
            'telefone.required' => 'É necessário preencher o campo telefone!',
            'email.email' => 'É necessário preencher o campo email com um email válido!',
            'motivo_contato' => 'É necessário preencher o campo motivo contato!',
            'mensagem.required' => 'É necessário preencher o campo mensagem!',
            
            'required' => 'O campo precisa ser preenchido!',
            'min' => 'O campo deve ter no mínimo 3 caracteres!'
        ];


        $request->validate($regras, $validacoes);

        SiteContato::create($request->all());
        //forma intânciando o objeto
        /* $contato = new SiteContato();
        $contato->fill($request->all());   
        $contato->save(); */
        return redirect()->route('site.index');
    }
}

  
/* nome' => 'required|min:3|max:40',   //nomes com no minimo 3 caracteres e no maximo 40
'telefone' => 'required',
'email' => 'email' ,
'motivo_contato' =>  'required',    
'mensagem' => 'required|max:2000' */

//validacao apenas com required
/* 'nome' => 'required',
'telefone' => 'required',
'email' => 'required',
'motivo_contato' => 'required',
'mensagem' => 'required'    */ 

/* [
'nome.required' => 'É necessário preencher o campo nome!',
'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres!',
'telefone.required' => 'É necessário preencher o campo telefone!',
'email.email' => 'É necessário preencher o campo email com um email válido!',
'motivo_contato' => 'É necessário preencher o campo motivo contato!',
'mensagem.required' => 'É necessário preencher o campo mensagem!',

'required' => 'O campo precisa ser preenchido!',
'min' => 'O campo deve ter no mínimo 3 caracteres!'



] */