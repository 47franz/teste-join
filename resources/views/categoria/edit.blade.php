@extends('layouts.padrao')
@section('content')
    <h1>Editar Categoria</h1>
    <hr>        
    <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
    <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Descrição:</label>
              <input type="text" class="form-control" name="descricao" value="{{ $categoria->descricao }}" maxlength="255" required/>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@stop
