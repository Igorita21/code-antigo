<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogAcessoMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[\App\Http\Controllers\PrincipalController::class, 'principal'])->name("site.index");
Route::get('/sobre-nos',[\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name("site.sobre-nos");
Route::get('/contato',[\App\Http\Controllers\ContatoController::class, 'contato'])->name("site.contato");
Route::post('/contato',[\App\Http\Controllers\ContatoController::class, 'salvar'])->name("site.contato");
Route::get('/login{erro?}', [\App\Http\Controllers\LoginController::class, 'index'])->name("site.login");
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'autenticar'])->name("site.login");

Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function(){
    Route::get('home', [\App\Http\Controllers\HomeController::class, 'index'])->name("app.home");
    Route::get('sair', [\App\Http\Controllers\LoginController::class, 'sair'])->name("app.sair");
    Route::get('cliente',  [\App\Http\Controllers\ClienteController::class, 'index'])->name("app.cliente");
    Route::get('fornecedor',[\App\Http\Controllers\FornecedorController::class, 'index'])->name("app.fornecedor");
    Route::post('fornecedor/listar',[\App\Http\Controllers\FornecedorController::class, 'listar'])->name("app.fornecedor.listar");
    Route::get('fornecedor/listar',[\App\Http\Controllers\FornecedorController::class, 'listar'])->name("app.fornecedor.listar");
    Route::get('fornecedor/editar/{id}/{msg?}',[\App\Http\Controllers\FornecedorController::class, 'editar'])->name("app.fornecedor.editar"); 
    Route::get('fornecedor/excluir/{id}',[\App\Http\Controllers\FornecedorController::class, 'excluir'])->name("app.fornecedor.excluir"); 
    Route::get('fornecedor/adicionar',[\App\Http\Controllers\FornecedorController::class, 'adicionar'])->name("app.fornecedor.adicionar");
    Route::post('fornecedor/adicionar',[\App\Http\Controllers\FornecedorController::class, 'adicionar'])->name("app.fornecedor.adicionar");

    //rota dedica a produtos
    Route::resource('produto', \App\Http\Controllers\ProdutoController::class);

    //produto detalhes.
    Route::resource('produto_detalhe', \App\Http\Controllers\ProdutoDetalheController::class);




}); 


Route::get('/teste/{p1}/{p2}', [\App\Http\Controllers\TesteController::class, 'teste'])->name("teste1");


Route::fallback(function(){ 
    echo 'A rota acessada não existe! <a href ="'.route('site.index').'" Clique aqui<a/> para ir para a página inicial!';
});






/*
    forma de construção das rotas
    Route::get($uri, $callback);
*/


/*verbos http
get 
post
put
catch
options

*/ 