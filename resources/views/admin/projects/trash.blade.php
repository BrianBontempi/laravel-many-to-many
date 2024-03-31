@extends('layouts.app')

@section('title', 'Progetti')
    
@section('content')

    <header class="d-flex justify-content-between align-items-center">
        <h1>Progetti eliminati</h1>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna indietro</a>
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
                </th>
            </tr>
        </thead>
        <tbody>
        @forelse($projects as $project)
            <tr class="align-middle text-center">
                <th scope="row">{{$project->id}}</th>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td>{{$project->created_at}}</td>
                <td>{{$project->updated_at}}</td>
                <td>
                    <div class="d-flex justify-content-end gap-2">
                        <form action="{{route('admin.projects.drop', $project->id)}}" method="POST" class="delete-form">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>

                        <form action="{{route('admin.projects.restore', $project->id)}}" method="POST">
                            @csrf 
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-arrows-rotate"></i>
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
@endsection

@section('scripts')
    @vite('resources/js/delete_confirmation.js')
@endsection