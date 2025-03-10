@extends('layouts.default')
@section('page-title', 'Usuários')

@section('page-actions')
    <a href="{{ route('users.create') }}" class="btn btn-primary">Adicionar</a>
@endsection

@section('content')
    {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}
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
        Coloquei o @can para dentro dos botões abaixo
    --}}
    {{-- @can('destroy', \App\Models\User::class)
        Posso deletar usuários
    @endcan --}}


    <form action="{{ route('users.index') }}" method="GET" style="width: 300px;">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" name="keyword" placeholder="Pesquise por nome ou e-mail"
                value="{{ request('keyword') }}">
            <button class="btn btn-primary" type="submit">Pesquisar</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @can('edit', \App\Models\User::class)
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        @endcan
                        @can('destroy', \App\Models\User::class)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
