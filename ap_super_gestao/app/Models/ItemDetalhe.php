<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    use HasFactory;
    protected $table = 'produto_detalhes';
    protected $fillable = [
        'produto_id', 'comprimento', 'altura', 'largura', 'unidade_id'
    ];

    //lembrar que os atributos passados por fillable devem ser os mesmo da tabela no banco 

    public function item(){
        return $this->belongsTo('App\Models\Item', 'produto_id' , 'id');
    }
}
