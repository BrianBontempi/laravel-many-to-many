@extends('layouts.app')

@section('title', 'Progetti')

@section('content')

<header>
    <h1 class="mb-4"> {{ $project->title}} </h1>
    <h4 class="fw-medium">Tipologia: @if($project->type)
        <span class="badge rounded-pill" style="background-color: {{ $project->type->color }}"> {{ $project->type->label }} </span>
        @else
        Nessuna
        @endif
    </h4>
</header>

<hr>

<div class="clearfix">
    @if ($project->image)
    <img src="{{ $project->printImage() }}" alt="{{ $project->title }}" class="me-2 float-start h-25 w-25">
    @endif
    <p>{{ $project->content}}</p>
    <div>
        <strong>Creato il:</strong> {{ $project->created_at }}
        <strong class="ms-4">Ultima modifica:</strong> {{ $project->updated_at }}
    </div>
</div>
<hr>
<footer class="d-flex justify-content-between align-items-center">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary"> Torna indietro</a>

    <div class="d-flex justify-content-between gap-2">
        <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-warning">
            <i class="fa-solid fa-pencil me-2"></i> Modifica
        </a>
        <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" class="delete-form">
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
@vite('resources/js/slug_preview.js')
@endsection
