<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProdutoCategoria extends Pivot
{
    protected $table = 'produto_categoria';
    protected $primaryKey = 'id';
}
