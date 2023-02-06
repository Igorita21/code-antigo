<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $metodo_autenticacao, $perfil)
    {

        //com a super global session determinamos que qualquer view dentro da middleware autenticacao necessitara de usuario e senha autenticados no login controller para serem visualizadas
        session_start();
        if(isset($_SESSION['email']) && $_SESSION['email'] != ""){
            return $next($request);
        }else{
            return redirect()->route('site.login', ['erro' => 2]);
        }
  
    }
}
