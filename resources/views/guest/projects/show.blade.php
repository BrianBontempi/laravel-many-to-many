@extends('layouts.app')

@section('title', 'Project')

@section('content')

    <div class="card mt-4">
        <div class="card-header">
            {{ $project->title}}
        </div>
        <div class="card-body">
            <div class="row">
                @if ($project->image)
                    <div class="col-3 text-center">
                        <img class="img-fluid" src="{{ $project->printImage() }}" alt="{{ $project->title }}">
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
@endsection