@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <header>
        <h1>Portfolio</h1>
        @if($projects->hasPages())
            {{ $projects->links() }}
        @endif
    </header>

    <hr>

    @forelse ($projects as $project)
    <div class="card mt-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            {{ $project->title}}
            <a href="{{route('guest.projects.show', $project->slug)}}" class="btn btn-sm btn-primary ">Vedi</a>
        </div>
        <div class="card-body">
            <div class="row">
                @if ($project->image)
                    <div class="col-3 text-center">
                        <img class="img-fluid" src="{{ $project->printImage()}}" alt="{{ $project->title }}">
                    </div>       
                @endif
                <div class="col">
                    <h5 class="card-title">{{ $project->title}}</h5>
                    <h6 class="card-subtitle my-3 text-body-secondary">{{ $project->created_at}}</h6>
                    <p class="card-text">{{ $project->content }}</p>
                </div>
            </div>
        </div>
    </div>
    @empty
        <h3 class="text-center">Non ci sono progetti</h3>   
    @endforelse
@endsection