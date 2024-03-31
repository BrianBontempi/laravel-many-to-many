@extends('layouts.app')

@section('title', 'Progetti')

@section('content')

<header class="d-flex justify-content-between align-items-center">
    <h1>Progetti</h1>
</header>

<table class="table table-striped">
    <thead>
        <tr class="align-middle text-center">
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Creato il</th>
            <th scope="col">Ultima modifica</th>
            <th>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.projects.trash') }}" class="btn btn-sm btn-secondary">
                        <i class="fa-solid fa-trash"></i>
                        Vedi cestino
                    </a>
                    <a href="{{route('admin.projects.create')}}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus me-2"></i>Crea progetto
                    </a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($projects as $project)
        <tr class="align-middle text-center">
            <th scope="row">{{$project->id}}</th>
            <td>{{$project->title}}</td>
            <td>
                @if($project->type)
                <span class="badge rounded-pill" style="background-color: {{ $project->type->color }}"> {{ $project->type->label }} </span>
                @else
                Nessuna
                @endif
            </td>
            <td>{{$project->slug}}</td>
            <td>{{$project->created_at}}</td>
            <td>{{$project->updated_at}}</td>
            <td>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{route('admin.projects.show', $project)}}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-eye"></i>
                    </a>

                    <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" class="delete-form">
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
            <td colspan="7">
                <h3 class="text-center">Non ci sono progetti</h3>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($projects->hasPages())
{{ $projects->links() }}
@endif

@endsection

@section('scripts')
@vite('resources/js/delete_confirmation.js')

<script>
    const titleField = document.getElementById('title');
    const slugField = document.getElementById('slug');

    titleField.addEventListener('blur', () => {
        slugField.value = titleField.value;
    })

</script>
@endsection
