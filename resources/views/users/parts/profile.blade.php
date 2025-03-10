<div class="card">
    <form action="{{ route('users.updateProfile', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-header">
            Perfil
        </div>

        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Tipo de Pessoa</label>
                <select name="person_type" class="form-control @error('person_type') is-invalid @enderror">
                    @foreach (['PF', 'PJ'] as $personType)
                        <option value={{ $personType }} @selected(old('person_type') == $personType || $personType == $user?->profile?->person_type)>{{ $personType }}</option>
                    @endforeach
                </select>
                @error('person_type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Endereço</label>
                <input type="text" name="address" value="{{ old('address') ?? $user?->profile?->address }}"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address') ?? $user->address }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>
