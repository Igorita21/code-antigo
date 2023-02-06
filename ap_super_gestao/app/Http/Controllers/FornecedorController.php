<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    
    public function index(){

        return view('app.fornecedor.index');
    }

    public function listar(Request $request){

        //recuperando dados do banco de dados para listagem 
        $fornecedores = Fornecedor::with(['produtos'])->where('nome','like','%'.$request->input('nome').'%')
        ->where('site','like','%'.$request->input('site').'%')
        ->where('uf','like','%'.$request->input('uf').'%')
        ->where('email','like','%'.$request->input('email').'%')
        ->paginate(5);

        return view('app.fornecedor.listar',['fornecedores' => $fornecedores, 'request' => $request->all()]);   
    }
     
    public function adicionar(Request $request){

        $msg = "";

        //inclusao
        if($request->input('_token') != "" && $request->input('id') == "") {
            //cadastro
            $regras = [
            'nome' => 'required|min: 3| max:40',
            'site' => 'required',
            'uf' => 'required|min:2|max:2',
            'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo três caracteres',
                'nome.max' => 'O campo nome deve ter no máximo quarenta caracteres',
                'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());


            //redirect
            $msg = "Cadastro realizado com sucesso!";
        }


        //edicao
        if($request->input('_token') != "" && $request->input('id') != ""){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());
            
        if($update){
            $msg = "Atualização realizada com sucesso!";
        }else{
            $msg = "Erro ao tentar atualizar o registro!";
        }
        
        return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        } 

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = ""){
        
        $fornecedor = Fornecedor::find($id);
        
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id){
        //como foi configurado com soft delete, apenas ira ser acrescentado a data de delete no banco
        Fornecedor::find($id)->delete();

        //caso realmente queira deletar um dado do banco que esta configurado com softdelete, utilizaamos o force delete;
        //Fornecedor::find($id)->forceDelete();

        return redirect()->route('app.fornecedor');
    }


}   
