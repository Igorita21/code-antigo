<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('site.login');
    }

    public function autenticar(Request $request){
        
        //regras de validação
        $regras = [
            'usuario' => 'email', 
            'senha' => 'required'
        ];
        
        //mensagens de validacoes
        $validacoes = [
            'usuario.email' => 'O campo usuário e-mail é obrigatório!', 
            'senha.required' => 'O campo senha é obrigatório!'
        ];
        
        //validacao dos dados
        $request->validate($regras, $validacoes);

        //pegando dados do formulario
        $email = $request->get('usuario');
        $password = $request->get('senha');

        //insercao dos dados no banco
        //iniciando o model User
        $user = new User();
        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->name)){
            //iniciando sessao que sera chamada no middleware autenticacao
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            return redirect()->route('app.home');
        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }


    //esse metodo destroi a sessão, e evita que possa ser acessadas as rotas protegidas pelos middlewares
    public function sair(){
        session_destroy();
        return redirect()->route('site.index');
    }
}