@extends('layouts.app')

@section('title', 'Articles')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Articles</h1>
                <a href="{{ route('articles.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create New Article
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Published At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr>
                            <td>
                                <strong>{{ $article->title }}</strong>
                                @if($article->image)
                                    <br><small class="text-muted">Has image</small>
                                @endif
                            </td>
                            <td>{{ $article->author }}</td>
                            <td>
                                @if($article->relationLoaded('category') ? $article->category : $article->category()->first())
                                    {{ optional($article->category)->name ?? optional($article->category()->first())->name }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($article->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning">Draft</span>
                                @endif
                            </td>
                            <td>
                                @if($article->published_at)
                                    {{ $article->published_at->format('d M Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                <p class="my-4">No articles found. Create your first article!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection