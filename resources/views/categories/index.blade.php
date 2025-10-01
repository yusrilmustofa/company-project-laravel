@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container">
  <div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
      <h1>Categories</h1>
      <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Create Category
      </a>
    </div>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif
  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($categories as $category)
            <tr>
              <td>
                <strong>{{ $category->name }}</strong>
                @if($category->description)
                <br><small class="text-muted">{{ Str::limit($category->description, 80) }}</small>
                @endif
              </td>
              <td>
                <span
                  class="badge bg-{{ $category->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($category->status) }}</span>
              </td>
              <td>
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this category?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="text-center text-muted">No categories found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">
        {{ $categories->links() }}
      </div>
    </div>
  </div>
</div>
@endsection