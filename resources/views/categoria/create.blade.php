@extends('layouts.padrao')
@section('content')
    <h1>Adicionar Categoria</h1>
    <hr>        
    <form method="POST" action="{{ url('/categorias') }}">
    <div class="form-group">
              @csrf
              <label for="name">Descrição:</label>
              <input type="text" class="form-control" name="descricao" maxlength="255" required/>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@stop
