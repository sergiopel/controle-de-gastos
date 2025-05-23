@extends('layouts.default')

@section('page-title', 'Receitas')

@section('page-actions')
    <a href="{{ route('incomes.create') }}" class="btn btn-primary">Adicionar</a>
@endsection

@section('content')

    @session('status')
        <div class="alert alert-success">
            {{ $value }}
        </div>
    @endsession

    <form action="{{ route('incomes.index') }}" method="GET" class="mb-4">
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
                    <th scope="col">Quantia</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Data</th>
                    <th scope="col" class="text-end">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomes as $income)
                    <tr>
                        <th scope="row">{{ $income->id }}</th>
                        <td>{{ number_format($income->amount, 2, ',', '.') }}</td>
                        <td>{{ $income->description }}</td>
                        <td>{{ $income->category->name }}</td>
                        <td>{{ date('d/m/Y', strtotime($income->date)) }}</td>
                        <td class="text-end">
                            <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('incomes.destroy', $income->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="table-active">
                    <td></td>
                    <td>{{ number_format($totalIncomes, 2, ',', '.') }}</td>
                    <td colspan="4">Total</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Layout de cartões visível apenas em telas pequenas -->
    <div class="d-md-none">
        <div class="mb-2 fw-bold">Total: {{ number_format($totalIncomes, 2, ',', '.') }}</div>

        @foreach ($incomes as $income)
            <div class="card mb-1">
                <div class="card-body py-2">
                    {{-- <h5 class="card-title fs-6 mb-1">{{ $income->description }}</h5> --}}
                    <div class="row mb-1">
                        <div class="col-6">{{ $income->description }}</div>
                        <div class="col-3 fw-bold small">Quantia:</div>
                        <div class="col-3 small">{{ number_format($income->amount, 2, ',', '.') }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-3 fw-bold small">Categoria:</div>
                        <div class="col-3 small text-truncate">{{ $income->category->name }}</div>
                        <div class="col-3 fw-bold small">Data:</div>
                        <div class="col-3 small">{{ date('d/m/Y', strtotime($income->date)) }}</div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('incomes.destroy', $income->id) }}" method="POST">
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
