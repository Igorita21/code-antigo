<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        //autenticação (email e senha)
        $credenciais = $request->all(['email', 'password']);
        //retornar um Json Web Token 
        $token = auth('api')->attempt($credenciais);
        if($token){//usuario correto
            return response()->json(['token' => $token]); 
        }else{//erro de usuario
            return response()->json(['erro' => 'O usuário ou senha inválidos!'], 403);
        }
        //401 = Unauthorized = não autorizado (possivel que usario esteja logado, porem nao esta autorizado sobre algum elemento da aplicação)
        //403 = proibido(login invalido)

        return "login";
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['msg' => 'O logout foi realizado com sucesso!']);
    }

    public function refresh(){
        $token = auth('api')->refresh();  //cliente encaminhe um jwt valido
        return response()->json(['token' => $token]);
    }

    public function me(){
        return response()->json(auth()->user());
    }
}
