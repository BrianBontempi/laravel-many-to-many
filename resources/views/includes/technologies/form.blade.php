@if($technology->exists)
<form action="{{ route('admin.technologies.update', $technology) }}" method="POST" novalidate>
    @method('PUT')
@else
<form action="{{ route('admin.technologies.store') }}" method="POST" novalidate>
@endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="label" class="form-label">Nome</label>
                <input type="text" name="label" class="form-control @error('label') is-invalid @elseif(old('label', '')) is-valid @enderror" id="label" placeholder="Nome..." value="{{ old('label', $technology->label) }}" required>
                @error('label')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @else
                <div class="form-text">
                    Inserisci il nome della tecnologia
                </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="color" class="form-label">Colore del badge</label>
                <select name="color" id="color" class="form-select @error('color') is-invalid @enderror">
                    <option value="">Nessuno</option>
                    @foreach ($colors as $color)
                    <option value="{{ $color }}" @if(old('color', $technology->color) == $color) selected @endif>{{ $color }}</option>
                    @endforeach
                </select>
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
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary">Torna indietro</a>

        <div class="d-flex align-items-center gap-2">
            <button type="reset" class="btn btn-secondary">Svuota i campi</button>
            <button type="submit" class="btn btn-success">Salva</button>
        </div>
    </div>
</form>
