@extends('layouts.padrao')
@section('content')
    <h1>Categorias</h1> 
    <hr>   
    <a class="btn btn-primary" href="{{ url('/categorias/create') }}" role="button">Nova Categoria</a>
         
    @if($categorias->count())
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Produtos</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)                
                <tr>
                    <th scope="row">{{ $categoria->descricao }}</th>
                    <td>{{ $categoria->produtos->count() }}</td>
                    <td>                        
                        <form action="{{ url('categorias', $categoria->id) }}" method="POST">
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                        </form>
                    </td>                    
                </tr>      
                @endforeach      
            </tbody>
        </table>
    {{ $categorias->links() }}
    @else
        <h2>Nenhum categoria cadastrada.</h2>
    @endif
@stop
