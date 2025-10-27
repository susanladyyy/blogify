@extends('layouts.master')

@section('content')

    <div class="container">
        @if (auth()->user()->role === \App\Enums\UserRole::Admin)
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#postModal">
                New Post
            </button>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            @forelse ($posts as $p)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $p->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($p->content, 100) }}</p>
                            <div class="d-flex flex-wrap gap-2 mt-auto">
                                <span class="badge bg-secondary">
                                    {{ $p->status->value }}
                                </span>
                                <span class="badge bg-secondary">
                                    {{ $p->source }}
                                </span>
                                <span class="badge bg-secondary">
                                    {{ $p->external_id ?? 'N/A' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href={{ route('admin.posts.show', $p) }} class="card-link">Read More</a>
                                @if (auth()->user()->role === \App\Enums\UserRole::Admin)
                                    <div class="d-flex gap-3">
                                        <button type="button" class="btn btn-secondary btn-sm edit-post-btn"
                                            data-bs-toggle="modal" data-bs-target="#postModal"
                                            data-post-id="{{ $p->id }}" data-post-title="{{ $p->title }}"
                                            data-post-content="{{ $p->content }}"
                                            data-post-status="{{ $p->status->value }}"
                                            data-update-url="{{ route('admin.posts.update', $p) }}">

                                            <i class="fas fa-pencil"></i>
                                        </button>
                                        <form action="{{ route('admin.posts.destroy', $p) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p>No posts yet.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
        @include('modal')
    </div>
@endsection
