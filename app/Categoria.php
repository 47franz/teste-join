<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    protected $fillable = array('descricao');

    /**
     * Produtos que pertencem à categoria
     */
    public function produtos()
    {
        //return $this->belongsToMany('App\Produto')->using('App\ProdutoCategoria');

        return $this->belongsToMany('App\Produto',  
                     'produto_categoria');
    }
}
