@extends('layouts.default')

@section('page-title', 'Categorias')

@section('page-actions')
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Adicionar</a>
@endsection

@section('content')
    @session('status')
        <div class="alert alert-success">
            {{ $value }}
        </div>
    @endsession

    {{--
        A diretiva @can é usada para verificar se o usuário logado tem permissão para executar uma ação
        Neste caso, estamos verificando se o usuário tem permissão para deletar outro usuário
        A função destroy() na UserPolicy é chamada para verificar se o usuário tem permissão
        \App\Models\User::class é o modelo que estamos verificando permissão
    --}}
    {{-- @can('destroy', \App\Models\User::class)
        Posso deletar usuários
    @endcan --}}


    <form action="{{ route('categories.index') }}" method="GET" class="mb-4">
        <div class="mb-3 input-group input-group-sm" style="max-width: 300px;">
            <input type="text" class="form-control" name="keyword" placeholder="Pesquise por nome ou e-mail"
                value="{{ request('keyword') }}">
            <button class="btn btn-primary" type="submit">Pesquisar</button>
        </div>
    </form>

    <!-- Tabela visível apenas em telas médias e grandes -->
    <div class="d-none d-md-block">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                    <tr>
                        <th scope="row">{{ $categorie->id }}</th>
                        <td>{{ $categorie->name }}</td>
                        <td>
                            @if ($categorie->type == 'expense')
                                <span class="badge bg-danger">Despesa</span>
                            @else
                                <span class="badge bg-success">Receita</span>
                            @endif
                        </td>
                        <td>{{ $categorie->description }}</td>
                        <td>
                            {{-- @can('edit', \App\Models\User::class) --}}
                            <a href="{{ route('categories.edit', $categorie->id) }}"
                                class="btn btn-primary btn-sm">Editar</a>
                            {{-- @endcan --}}
                            {{-- @can('destroy', \App\Models\User::class) --}}
                            <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                            {{-- @endcan --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Layout de cartões visível apenas em telas pequenas -->
    <div class="d-md-none">
        @foreach ($categories as $categorie)
            <div class="card mb-1">
                <div class="card-body py-2">
                    {{-- <h5 class="card-title fs-6 mb-1">{{ $categorie->name }}</h5> --}}
                    <div class="row mb-1">
                        <div class="col-6">{{ $categorie->name }}</div>
                        <div class="col-3 fw-bold small">Tipo:</div>
                        <div class="col-3 small">
                            @if ($categorie->type == 'expense')
                                <span class="badge bg-danger">Despesa</span>
                            @else
                                <span class="badge bg-success">Receita</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-4 fw-bold small">Descrição:</div>
                        <div class="col-8 small">{{ $categorie->description }}</div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- {{ $users->links() }} --}}
@endsection
