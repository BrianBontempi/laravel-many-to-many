@extends('layouts.app')

@section('title', 'Tecnologie')

@section('content')

<header class="d-flex justify-content-between align-items-center">
    <h1>Tecnologie</h1>
    <a href="{{ route('admin.technologies.create') }}" class="btn btn-sm btn-success">
        <i class="fas fa-plus me-2"></i>Crea tecnologia
    </a>
</header>

<table class="table table-striped">
    <thead>
        <tr class="align-middle text-center">
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Colore</th>
            <th scope="col">Progetti</th>
            <th scope="col">Creata il</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($technologies as $technology)
        <tr class="align-middle text-center">
            <th scope="row">{{ $technology->id }}</th>
            <td>
                <span class="badge rounded-pill text-bg-{{ $technology->color ?? 'secondary' }}">{{ $technology->label }}</span>
            </td>
            <td>{{ $technology->color ?? '-' }}</td>
            <td>{{ $technology->projects_count }}</td>
            <td>{{ $technology->created_at }}</td>
            <td>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.technologies.show', $technology) }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" class="delete-form" data-entity="la tecnologia">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">
                <h3 class="text-center">Non ci sono tecnologie</h3>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection

@section('scripts')
@vite('resources/js/delete_confirmation.js')
@endsection
