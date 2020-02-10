@extends('layouts.padrao')
@section('content')
    <h1>Editar Produto</h1>
    <hr>        
    <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
        <div class="form-group">
            @csrf
            @method('PATCH')
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" name="descricao" value="{{ $produto->descricao }}"  maxlength="255" required/>
            <label for="valor">Valor:</label>
            <input type="number" step="any" class="form-control" name="valor" value="{{ $produto->valor }}"  maxlength="10" required/>
            <label for="codigo">Código:</label>
            <input type="text" class="form-control" name="codigo" value="{{ $produto->codigo }}"  maxlength="8" required/>
        </div>
        <div class="form-group">
            <label for="categorias">Categorias:</label>
            @foreach ($categorias as $categoria)
                <input type="checkbox" name="categoria[]" value="{{$categoria->id}}" @if(in_array($categoria->id, $categoriasSelecionadas)) checked @endif/>
                {{$categoria->descricao}} 
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@stop
