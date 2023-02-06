<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    public function item_detalhe(){
        return $this->hasOne('App\Models\ProdutoDetalhe');
    }

    //dessa forma estamos dizendo que produto tem 1 produto detalhe
    //um registro relacionado em produto detalhes (fk) -> produto_id
    //produtos (pk) -> id
}
