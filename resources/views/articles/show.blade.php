@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articles</a></li>
                    <li class="breadcrumb-item active">{{ $article->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1>{{ $article->title }}</h1>
                    <div class="text-muted">
                        <small>
                            By {{ $article->author }} | 
                            @if($article->published_at)
                                Published: {{ $article->published_at->format('d M Y H:i') }}
                            @else
                                Not published yet
                            @endif
                        </small>
                        <br>
                        <span class="badge bg-{{ $article->status === 'published' ? 'success' : 'warning' }} mt-2">
                            {{ ucfirst($article->status) }}
                        </span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>

            @if($article->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $article->image) }}" 
                         alt="{{ $article->title }}" 
                         class="img-fluid rounded">
                </div>
            @endif

            <div class="article-content">
                {!! nl2br(e($article->content)) !!}
            </div>

            <hr class="my-4">

            <div class="text-muted small">
                <p>
                    <strong>Slug:</strong> {{ $article->slug }}<br>
                    <strong>Created:</strong> {{ $article->created_at->format('d M Y H:i') }}<br>
                    <strong>Last Updated:</strong> {{ $article->updated_at->format('d M Y H:i') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection