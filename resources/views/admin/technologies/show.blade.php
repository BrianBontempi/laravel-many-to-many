@extends('layouts.app')

@section('title', 'Tecnologia')

@section('content')

<header>
    <h1 class="mb-4">
        <span class="badge rounded-pill text-bg-{{ $technology->color ?? 'secondary' }}">{{ $technology->label }}</span>
    </h1>
</header>

<hr>

<h4>Progetti con questa tecnologia</h4>
<ul class="list-group mb-4">
    @forelse ($technology->projects as $project)
    <li class="list-group-item">
        <a href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a>
    </li>
    @empty
    <li class="list-group-item">Nessun progetto</li>
    @endforelse
</ul>

<hr>
<footer class="d-flex justify-content-between align-items-center">
    <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary">Torna indietro</a>

    <div class="d-flex justify-content-between gap-2">
        <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning">
            <i class="fa-solid fa-pencil me-2"></i> Modifica
        </a>
        <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" class="delete-form" data-entity="la tecnologia">
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
