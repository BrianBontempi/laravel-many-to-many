@extends('layouts.app')

@section('title', 'Tipologie')

@section('content')

<header class="d-flex justify-content-between align-items-center">
    <h1>Tipologie</h1>
    <a href="{{ route('admin.types.create') }}" class="btn btn-sm btn-success">
        <i class="fas fa-plus me-2"></i>Crea tipologia
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
        @forelse($types as $type)
        <tr class="align-middle text-center">
            <th scope="row">{{ $type->id }}</th>
            <td>
                <span class="badge rounded-pill" style="background-color: {{ $type->color }}">{{ $type->label }}</span>
            </td>
            <td>{{ $type->color }}</td>
            <td>{{ $type->projects_count }}</td>
            <td>{{ $type->created_at }}</td>
            <td>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.types.show', $type) }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <form action="{{ route('admin.types.destroy', $type) }}" method="POST" class="delete-form" data-entity="la tipologia">
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
                <h3 class="text-center">Non ci sono tipologie</h3>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection

@section('scripts')
@vite('resources/js/delete_confirmation.js')
@endsection
