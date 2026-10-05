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
        @include('includes.projects.guest.card')
    @empty
        <h3 class="text-center">Non ci sono progetti</h3>   
    @endforelse
@endsection