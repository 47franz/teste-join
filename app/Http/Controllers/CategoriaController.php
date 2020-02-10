<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::orderBy('created_at', 'desc')->paginate(10);

        return view('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'descricao' => 'required|max:255',
        ];
    
        $customMessages = [
            'required' => 'Informe o (a) :attribute.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        $categoria = new Categoria([
            'descricao' => $request->get('descricao')
        ]);
        $categoria->save();
        return redirect('/categorias')->with('success', 'Categoria adicionada com sucesso');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'descricao' => 'required|max:255',
        ];
    
        $customMessages = [
            'required' => 'Informe o (a) :attribute.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        $categoria = Categoria::find($id);
        $categoria->descricao = $request->get('descricao');
        $categoria->save();
    
        return redirect('/categorias')->with('success', 'Categoria atualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect('/categorias')->with('success', 'Categoria Deletada');
    }

}
