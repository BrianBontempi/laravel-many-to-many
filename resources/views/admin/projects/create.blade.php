@extends('layouts.app')

@section('title', 'Crea Progetto')
    
@section('content')

    <header>
        <h1>Nuovo progetto</h1>
    </header>

    <hr>

    @include('includes.projects.form')

@endsection

@section('scripts')
    @vite('resources/js/image_preview.js')
    @vite('resources/js/slug_preview.js')
@endsection
