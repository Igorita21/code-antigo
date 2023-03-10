<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\ProdutoDetalhe;
use App\Models\Item;
use App\Models\ItemDetalhe;
use App\Models\Fornecedor;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                      ///eager loading
        $produtos = Item::with(['item_detalhe', 'fornecedor'])->paginate(10);

        /* foreach($produtos as $key => $produto){
           // print_r($produto->getAttributes());
            //echo '<br><br><br>';

            $produto_detalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();

            if(isset($produto_detalhe)){
                $produtos[$key]['comprimento'] = $produto_detalhe->comprimento;
                $produtos[$key]['largura'] = $produto_detalhe->largura;
                $produtos[$key]['altura'] = $produto_detalhe->altura;
            }
            //echo '<hr>';

        } */


        return view('app.produto.index',['produtos' => $produtos, 'request' => $request->all()]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no m??nimo 3 caracteres',
            'nome.max' => "O campo nome deve ter no m??ximo 40 caracteres",
            'decricao.max' => 'O campo descri????o deve ter no m??ximo 2000 caracteres',
            'descricao.min' => 'O campo descri????o deve ter no m??nimo 3 caracteres',
            'peso.integer' => 'O campo peso deve ser preenchido com um n??mero inteiro',
            'unidade_id.exists' => 'A unidade de medida informada n??o existe'
        ];

        $request->validate($regras, $feedback);

        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
        //return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
       $produto->delete();
       return redirect()->route('produto.index');
    }
}
