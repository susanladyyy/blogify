@extends('layouts.master')

@section('content')
<div class="container">
    <div class="mb-4">
        <h1>{{ $post->title }}</h1>
        <div class="d-flex flex-wrap gap-2 mt-auto">
            <span class="badge bg-secondary">
                {{ $post->status->value }}
            </span>
            <span class="badge bg-secondary">
                {{ $post->source }}
            </span>
            <span class="badge bg-secondary">
                {{ $post->external_id ?? 'N/A' }}
            </span>
        </div>
    </div>
    <p>{{ $post->content }}</p>
</div>
@endsection
