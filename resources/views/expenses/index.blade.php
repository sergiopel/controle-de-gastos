@extends('layouts.default')

@section('page-title', 'Despesas')

@section('page-actions')
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Adicionar</a>
@endsection

@section('content')
    @session('status')
        <div class="alert alert-success">
            {{ $value }}
        </div>
    @endsession

    <form action="{{ route('expenses.index') }}" method="GET" style="width: 300px;">
        <div class="mb-3 input-group input-group-sm">
            <input type="text" class="form-control" name="keyword" placeholder="Pesquise por nome ou e-mail"
                value="{{ request('keyword') }}">
            <button class="btn btn-primary" type="submit">Pesquisar</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Quantia</th>
                <th scope="col">Descrição</th>
                <th scope="col">Categoria</th>
                <th scope="col">Data</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <th scope="row">{{ $expense->id }}</th>
                    {{-- number_format() formata números:
                        1º parâmetro ($expense->amount): o número a ser formatado
                        2º parâmetro (2): quantidade de casas decimais
                        3º parâmetro (','): separador decimal (vírgula no padrão BR)
                        4º parâmetro ('.'): separador de milhar (ponto no padrão BR)
                        Exemplo: 1234.56 -> 1.234,56
                    --}}
                    <td>{{ number_format($expense->amount, 2, ',', '.') }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->category->name }}</td>
                    {{-- a linha abaixo está formatando a data para o formato dd/mm/yyyy --}}
                    {{-- a função strtotime converte a data para o formato timestamp --}}
                    {{-- o formato timestamp é o número de segundos desde 1 de janeiro de 1970 --}}
                    {{-- o formato dd/mm/yyyy é o formato de data brasileiro --}}   
                    {{-- a função date() é usada para formatar a data --}}
                    {{-- o parâmetro 'd/m/Y' é o formato de data brasileiro --}}
                    {{-- o parâmetro strtotime($expense->date) é a data a ser formatada --}}
                    <td>{{ date('d/m/Y', strtotime($expense->date)) }}</td>
                    <td>
                        <a href="{{-- route('expenses.edit', $expense->id) --}}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{-- route('expenses.destroy', $expense->id) --}}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                        {{-- @can('edit', \App\Models\User::class) --}}
                            {{-- <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-primary btn-sm">Editar</a> --}}
                        {{-- @endcan --}}
                        {{-- @can('destroy', \App\Models\User::class) --}}
                            {{-- <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form> --}}
                        {{-- @endcan --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $users->links() }} --}}
@endsection
