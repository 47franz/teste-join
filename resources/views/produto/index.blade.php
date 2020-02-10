@extends('layouts.padrao')
@section('content')
    <h1>Produtos</h1>
    <hr>        
    <a class="btn btn-primary" href="{{ url('/produtos/create') }}" role="button">Novo Produto</a>
    @if($produtos->count())
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Código</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Categorias</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)                
                <tr>
                    <th scope="row">{{ $produto->codigo }}</th>
                    <td>{{ $produto->descricao }}</td>
                    <td>{{ $produto->valor }}</td>
                    <td>
                        @if($produto->categorias->count())
                            @foreach ($produto->categorias as $categoria)
                                <span class="badge badge-light">{{ $categoria->descricao }}</span> 
                            @endforeach
                        @endif
                    </td>
                    <td>                        
                        <form action="{{ url('produtos', $produto->id) }}" method="POST">
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                        </form>
                    </td>                           
                </tr>      
                @endforeach      
            </tbody>
        </table>
    {{ $produtos->links() }}
    @else
        <h2>Nenhum produto cadastrado.</h2>
    @endif
@stop
