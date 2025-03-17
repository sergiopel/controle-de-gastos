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
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->category->name }}</td>
                    
                    <td>
                        Ação
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
