@if($project->exists)
<form action="{{ route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data" novalidate>
    @method('PUT')

    @else
    <form action="{{ route('admin.projects.store')}}" method="POST" enctype="multipart/form-data" novalidate>

        @endif

        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @elseif(old('title', '')) is-valid @enderror" id="title" placeholder="Titolo..." value="{{old('title', $project->title)}}" required>
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @else
                    <div class="form-text">
                        Inserisci il titolo del post
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" value="{{ Str::slug(old('title', $project->title)) }}" disabled>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="content" class="form-label">Descrizione</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @elseif(old('content', '')) is-valid @enderror" id="content" rows="30" required> {{ old('content', $project->content)}}
                    </textarea>
                    @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @else
                    <div class="form-text">
                        Inserisci la descrizione del progetto
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label for="type_id" class="form-label">Seleziona Tipologia</label>
                <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @elseif(old('type_id', '')) is-valid @enderror">
                    <option value="">Nessuna</option>
                    @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if(old('type_id', $project->type?->id) == $type->id) selected @endif()>{{ $type->label }}</option>
                    @endforeach
                </select>
                @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-5">
                <div class="mb-3">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="file" class="form-control @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror" name="image" id="image" placeholder="http://... o https://..." value="{{ old('image', $project->image)}}">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @else
                    <div class="form-text">
                        carica un file immagine
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-1 d-flex align-items-center">
                <div class="mb-3">
                    <img src="{{ old('image', $project->image)
                    ? $project->printImage()
                    : 'https://marcolanci.it/boolean/assets/placeholder.png' }}" class="img-fluid" alt="{{ $project->image ? $project->title : 'preview'}}" id="preview">
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Torna indientro</a>

            <div class="d-flex align-items-center gap-2">
                <button type="reset" class="btn btn-secondary">Svuota i campi</button>
                <button type="submit" class="btn btn-success">Salva</button>
            </div>
        </div>
    </form>
