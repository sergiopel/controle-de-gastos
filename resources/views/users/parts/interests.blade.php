<div class="card">
    <form action="{{ route('users.updateInterests', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-header">
            Interesses
        </div>

        <div class="card-body">
            @foreach (['Futebol', 'Fórmula 1', 'Ciclismo', 'Vôlei', 'Basquete', 'Tênis', 'Natação', 'Atletismo', 'Outros'] as $item)
                <div class="form-check">
                    <input
                        class="form-check-input @error('interests') is-invalid @enderror"
                        name="interests[][name]"
                        type="checkbox"
                        value="{{ $item }}"
                        @checked($user->interests->contains('name', $item))
                    >
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $item }}
                    </label>
                    @if ($loop->last)
                        @error('interests')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    @endif
                </div>
            @endforeach
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>
