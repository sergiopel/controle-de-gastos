@extends('layouts.default')

@section('page-title', 'Editar Despesa')

@section('content')
<form method="POST" action="{{ route('expenses.update', $expense->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3 row">
        <label for="description" class="form-label">{{ __('Descrição') }}</label>
        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"
            value="{{ old('description') ?? $expense->description }}" autocomplete="description" autofocus>

        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 row">
        <label for="amount" class="form-label">{{ __('Valor') }}</label>
        <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount"
            value="{{ old('amount') ?? number_format($expense->amount, 2, ',', '.') }}" autocomplete="amount" autofocus>

        @error('amount')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 row">
        <label for="type" class="form-label">{{ __('Categoria') }}</label>

        <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
            <option value="">Selecione a categoria</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id || $category->id == $expense->category_id)>{{ $category->name }}</option>
            @endforeach
        </select>

        @error('type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 row">
        <label for="date" class="form-label">{{ __('Data') }}</label>
        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date"
            value="{{ old('date') ?? $expense->date }}" autocomplete="date" autofocus>

        @error('date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-0 row">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Editar') }}
            </button>
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                {{ __('Cancelar') }}
            </a>
        </div>
    </div>
</form>

@endsection
