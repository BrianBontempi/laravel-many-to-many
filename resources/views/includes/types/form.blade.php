@if($type->exists)
<form action="{{ route('admin.types.update', $type) }}" method="POST" novalidate>
    @method('PUT')
@else
<form action="{{ route('admin.types.store') }}" method="POST" novalidate>
@endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="label" class="form-label">Nome</label>
                <input type="text" name="label" class="form-control @error('label') is-invalid @elseif(old('label', '')) is-valid @enderror" id="label" placeholder="Nome..." value="{{ old('label', $type->label) }}" required>
                @error('label')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @else
                <div class="form-text">
                    Inserisci il nome della tipologia
                </div>
                @enderror
            </div>
        </div>
        <div class="col-2">
            <div class="mb-3">
                <label for="color" class="form-label">Colore</label>
                <input type="color" name="color" class="form-control form-control-color @error('color') is-invalid @enderror" id="color" value="{{ old('color', $type->color ?? '#ffffff') }}">
                @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.types.index') }}" class="btn btn-primary">Torna indietro</a>

        <div class="d-flex align-items-center gap-2">
            <button type="reset" class="btn btn-secondary">Svuota i campi</button>
            <button type="submit" class="btn btn-success">Salva</button>
        </div>
    </div>
</form>
