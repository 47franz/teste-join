@extends('layouts.padrao')
@section('content')
    <h1>Adicionar Produto</h1>
    <hr>        
    <form method="POST" action="{{ url('/produtos') }}">
        <div class="form-group">
            @csrf
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" name="descricao" maxlength="255" required/>
            <label for="valor">Valor:</label>
            <input type="number" step="any" class="form-control" name="valor" maxlength="255" required/>
            <label for="codigo">Código:</label>
            <input type="text" class="form-control" name="codigo" maxlength="255" required/>
        </div>
        <div class="form-group">
            <label for="categorias">Categorias:</label>
            @foreach ($categorias as $categoria)
                <input type="checkbox" name="categoria[]" value="{{$categoria->id}}" />
                {{$categoria->descricao}}
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@stop
