<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produto';
    protected $primaryKey = 'id';
    protected $fillable = array('codigo','descricao','valor','categoria');

    /**
     * Categorias às quais pertence o produto.
     */
    public function categorias()
    {
        return $this->belongsToMany('App\Categoria',  
                     'produto_categoria');
    }
}
