<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
    use HasFactory; 
    protected $fillable = [
        'produto_id', 'comprimento', 'altura', 'largura', 'unidade_id'
    ];

    //lembrar que os atributos passados por fillable devem ser os mesmo da tabela no banco 

    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }


}

