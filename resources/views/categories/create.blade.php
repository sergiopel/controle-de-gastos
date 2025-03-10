@extends('layouts.default')
@section('page-title', 'Adicionar Categoria')
@section('content')

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="mb-3 row">
            <label for="name" class="form-label">{{ __('Nome') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 row">
            <label for="type" class="form-label">{{ __('Tipo') }}</label>

            <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
                <option value="">Selecione um tipo</option>
                <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Despesa</option>
                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Receita</option>
            </select>

            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 row">
            <label for="description" class="form-label">{{ __('Descrição') }}</label>

                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                    rows="3">{{ old('description') }}</textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="mb-0 row">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Cadastrar') }}
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    {{ __('Cancelar') }}
                </a>
            </div>
        </div>
    </form>

@endsection
