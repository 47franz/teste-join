<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use App\Categoria;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::orderBy('created_at', 'desc')->paginate(10);

        return view('produto.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('produto.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codigo = $request->get('codigo');
        $rules = [
            'codigo' => 'required|unique:produto',
            'descricao' => 'required|max:255',
            'valor' => 'numeric|between:0,99999.99'
        ];
    
        $customMessages = [
            'required' => 'Informe o (a) :attribute.',
            'unique' => 'Código já utilizado.',
            'between' => 'Informe um valor válido',
            'numeric' => 'Informe um valor válido'
        ];        
    
        $this->validate($request, $rules, $customMessages);        

        $produto = new Produto([
            'codigo' => $codigo,
            'descricao' => $request->get('descricao'),
            'valor' => $request->get('valor')
        ]);
        
        $produto->save();

        $categorias = Categoria::find($request->get('categoria'));
        $produto->categorias()->attach($categorias);

        return redirect('/produtos')->with('success', 'Produto adicionado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        $categorias = Categoria::all();

        $categoriasSelecionadas = $produto->categorias->pluck('id')->toArray();

        return view('produto.edit', [
            'produto' => $produto,
            'categorias' => $categorias,
            'categoriasSelecionadas' => $categoriasSelecionadas
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'codigo' => 'required',
            'descricao' => 'required|max:255',
            'valor' => 'numeric|between:0,99999.99'
        ];
    
        $customMessages = [
            'required' => 'Informe o (a) :attribute.',
            'between' => 'Informe um valor válido',
            'numeric' => 'Informe um valor válido'
        ];        
    
        $this->validate($request, $rules, $customMessages);        

        $produto = Produto::find($id);
        $produto->codigo = $request->get('codigo');
        $produto->descricao = $request->get('descricao');
        $produto->valor = $request->get('valor');
        
        $produto->save();
        $produto->categorias()->detach();

        $categorias = Categoria::find($request->get('categoria'));
        $produto->categorias()->attach($categorias);

        return redirect('/produtos')->with('success', 'Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return redirect('/produtos')->with('success', 'Produto Deletado');
    }
}
