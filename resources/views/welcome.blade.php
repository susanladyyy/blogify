@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="mb-4">
            Hello, {{ auth()->check() ? auth()->user()->name : 'Guest' }}!
        </h1>

    </div>
@endsection
