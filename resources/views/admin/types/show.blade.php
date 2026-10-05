@extends('layouts.app')

@section('title', 'Tipologia')

@section('content')

<header>
    <h1 class="mb-4">
        <span class="badge rounded-pill" style="background-color: {{ $type->color }}">{{ $type->label }}</span>
    </h1>
</header>

<hr>

<h4>Progetti con questa tipologia</h4>
<ul class="list-group mb-4">
    @forelse ($type->projects as $project)
    <li class="list-group-item">
        <a href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a>
    </li>
    @empty
    <li class="list-group-item">Nessun progetto</li>
    @endforelse
</ul>

<hr>
<footer class="d-flex justify-content-between align-items-center">
    <a href="{{ route('admin.types.index') }}" class="btn btn-primary">Torna indietro</a>

    <div class="d-flex justify-content-between gap-2">
        <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning">
            <i class="fa-solid fa-pencil me-2"></i> Modifica
        </a>
        <form action="{{ route('admin.types.destroy', $type) }}" method="POST" class="delete-form" data-entity="la tipologia">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-trash me-2"></i> Elimina
            </button>
        </form>
    </div>
</footer>
@endsection

@section('scripts')
@vite('resources/js/delete_confirmation.js')
@endsection
