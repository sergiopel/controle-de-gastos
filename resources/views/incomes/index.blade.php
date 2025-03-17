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

    <form action="{{ route('incomes.index') }}" method="GET" style="width: 300px;">
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
            @foreach ($incomes as $income)
                <tr>
                    <th scope="row">{{ $income->id }}</th>
                    <td>{{ number_format($income->amount, 2, ',', '.') }}</td>
                    <td>{{ $income->description }}</td>
                    <td>{{ $income->category->name }}</td>
                    <td>{{ date('d/m/Y', strtotime($income->date)) }}</td>
                    <td>
                        <a href="{{-- route('incomes.edit', $income->id) --}}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{-- route('incomes.destroy', $income->id) --}}" method="POST"
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

    {{-- {{ $users->links() }} --}}

@endsection
